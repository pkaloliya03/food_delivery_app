<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('city')
            ->where('status', true)
            ->latest()
            ->get();

        $items = Item::with(['category', 'restaurant'])
            ->where('status', true)
            ->latest()
            ->get();

        return view('user.home', compact('restaurants', 'items'));
    }
}
