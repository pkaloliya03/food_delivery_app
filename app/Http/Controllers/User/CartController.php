<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add an item to the cart.
     * Guests and logged-in customers can both use the cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'item_id' => ['required', 'integer', 'exists:master_items,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        // Only active items from active restaurants can be added.
        $item = Item::where('id', $validated['item_id'])
            ->where('status', true)
            ->whereHas('restaurant', function ($query) {
                $query->where('status', true);
            })
            ->first();

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'This food item is currently unavailable.',
            ], 422);
        }

        $quantity = $validated['quantity'] ?? 1;

        // Cart is stored in the current session.
        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        // One restaurant per cart.
        if (
            !empty($cart['items']) &&
            (int) $cart['restaurant_id'] !== (int) $item->restaurant_id
        ) {
            return response()->json([
                'success' => false,
                'type' => 'different_restaurant',
                'message' => 'Your cart contains items from another restaurant. Please clear your cart before adding items from this restaurant.',
            ], 422);
        }

        // Set the restaurant for a new cart.
        if (empty($cart['items'])) {
            $cart['restaurant_id'] = $item->restaurant_id;
        }

        $itemKey = (string) $item->id;

        // Add a new item or increase its quantity.
        $currentQuantity = $cart['items'][$itemKey]['quantity'] ?? 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > 99) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum quantity for one item is 99.',
            ], 422);
        }

        $cart['items'][$itemKey] = [
            'item_id' => $item->id,
            'quantity' => $newQuantity,
        ];

        session()->put('cart', $cart);

        $cartCount = collect($cart['items'])
            ->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => $item->name . ' added to cart.',
            'cart_count' => $cartCount,
        ]);
    }


    public function index()
    {
        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        $itemIds = collect($cart['items'] ?? [])
            ->keys()
            ->all();

        $databaseItems = \App\Models\Item::with('restaurant')
            ->whereIn('id', $itemIds)
            ->get()
            ->keyBy('id');

        $cartItems = collect($cart['items'] ?? [])
            ->map(function ($cartItem, $itemId) use ($databaseItems) {
                $item = $databaseItems->get($itemId);

                if (!$item) {
                    return null;
                }

                return [
                    'item' => $item,
                    'quantity' => (int) $cartItem['quantity'],
                    'subtotal' => (float) $item->price
                        * (int) $cartItem['quantity'],
                ];
            })
            ->filter()
            ->values();

        $total = $cartItems->sum('subtotal');

        return view('user.cart', compact(
            'cartItems',
            'total'
        ));
    }


    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'item_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        $itemKey = (string) $validated['item_id'];

        if (!isset($cart['items'][$itemKey])) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in your cart.',
            ], 404);
        }

        $cart['items'][$itemKey]['quantity'] = (int) $validated['quantity'];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'cart_count' => collect($cart['items'])->sum('quantity'),
        ]);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'item_id' => ['required', 'integer'],
        ]);

        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        $itemKey = (string) $validated['item_id'];

        if (!isset($cart['items'][$itemKey])) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in your cart.',
            ], 404);
        }

        unset($cart['items'][$itemKey]);

        // Reset restaurant when cart becomes empty.
        if (empty($cart['items'])) {
            $cart['restaurant_id'] = null;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart.',
            'cart_count' => collect($cart['items'])->sum('quantity'),
        ]);
    }
}
