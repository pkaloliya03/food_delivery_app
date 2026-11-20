<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            return redirect()->route('home');
        }

        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        if (empty($cart['items'])) {
            return redirect()->route('cart.index');
        }

        return view('user.checkout');
    }


    public function store(Request $request)
    {
        // Only logged-in customers can place orders.
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            return redirect()->route('home');
        }

        $customer = Auth::user();

        // City must come from the selected city session, not the form.
        $selectedCity = session('selected_city_name');

        if (empty($selectedCity)) {
            return redirect()->route('home')
                ->with('error', 'Please select your delivery city first.');
        }

        // Validate checkout details.
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10'],
            'address' => ['required', 'string', 'max:2000'],
            'pincode' => ['required', 'digits:6'],
            'instructions' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        if (empty($cart['items']) || empty($cart['restaurant_id'])) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Verify restaurant and its owner.
        $restaurant = Restaurant::with('owner')
            ->where('id', $cart['restaurant_id'])
            ->where('status', true)
            ->first();

        if (!$restaurant || !$restaurant->owner) {
            return back()->with('error', 'Restaurant is currently unavailable.');
        }

        try {
            $order = DB::transaction(function () use (
                $cart,
                $restaurant,
                $validated,
                $customer,
                $selectedCity
            ) {
                $itemIds = array_keys($cart['items']);

                // Fetch current item details and prices from database.
                $items = Item::whereIn('id', $itemIds)
                    ->where('restaurant_id', $restaurant->id)
                    ->where('status', true)
                    ->get()
                    ->keyBy('id');

                if ($items->count() !== count($itemIds)) {
                    throw new \RuntimeException(
                        'One or more items in your cart are unavailable.'
                    );
                }

                $subtotal = 0;

                foreach ($cart['items'] as $itemId => $cartItem) {
                    $item = $items->get($itemId);
                    $quantity = (int) $cartItem['quantity'];

                    if (!$item || $quantity < 1 || $quantity > 99) {
                        throw new \RuntimeException(
                            'Invalid cart item or quantity.'
                        );
                    }

                    $subtotal += (float) $item->price * $quantity;
                }

                // Create order.
                $order = Order::create([
                    'order_no' => 'TEMP-' . Str::uuid(),
                    'customer_id' => $customer->id,
                    'username' => $customer->username,
                    'customer_name' => $validated['customer_name'],
                    'mobile' => $validated['mobile'],
                    'restaurant_id' => $restaurant->id,
                    'address' => $validated['address'],
                    'city' => $selectedCity,
                    'pincode' => $validated['pincode'],
                    'instructions' => $validated['instructions'] ?? null,
                    'subtotal' => $subtotal,
                    'delivery_charge' => 0,
                    'total_amount' => $subtotal,
                    'status' => 'pending',
                ]);

                // Generate final order number using the unique order ID.
                $order->update([
                    'order_no' => 'FD' . now()->format('Y') . '-' .
                        str_pad($order->id, 6, '0', STR_PAD_LEFT),
                ]);

                // Save individual order items.
                foreach ($cart['items'] as $itemId => $cartItem) {
                    $item = $items->get($itemId);
                    $quantity = (int) $cartItem['quantity'];
                    $price = (float) $item->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'item_id' => $item->id,
                        'item_name' => $item->name,
                        'price' => $price,
                        'quantity' => $quantity,
                        'total' => $price * $quantity,
                    ]);
                }

                // Notify the restaurant owner.
                $restaurant->owner->notify(
                    new NewOrderNotification($order)
                );

                return $order;
            });
        } catch (\RuntimeException $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        }

        // Clear cart only after successful order creation.
        session()->forget('cart');

        return redirect()->route('home')
            ->with(
                'success',
                'Your order has been placed successfully! Order No: ' . $order->order_no
            );
    }
}
