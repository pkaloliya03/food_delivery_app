<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        abort_unless(
            Auth::user()->role === 'restaurant_owner',
            403
        );

        $restaurantIds = Restaurant::where('owner_id', Auth::id())
            ->pluck('id');

        $baseQuery = Order::whereIn('restaurant_id', $restaurantIds);

        $orderStats = [
            'total' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'accepted' => (clone $baseQuery)->where('status', 'accepted')->count(),
            'delivered' => (clone $baseQuery)->where('status', 'delivered')->count(),
        ];

        $orders = Order::with([
            'restaurant',
            'items',
            'customer',
        ])
            ->whereIn('restaurant_id', $restaurantIds)
            ->latest()
            ->paginate(15);

        return view('owner.orders', compact('orders', 'orderStats'));
    }
}
