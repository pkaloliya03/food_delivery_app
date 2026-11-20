<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Only customer can access checkout.
        if (!Auth::check() || Auth::user()->role !== 'customer') {
            return redirect()->route('home');
        }

        // Check whether cart has items.
        $cart = session()->get('cart', [
            'restaurant_id' => null,
            'items' => [],
        ]);

        if (empty($cart['items'])) {
            return redirect()->route('cart.index');
        }

        return view('user.checkout');
    }
}
