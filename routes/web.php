<?php

use Illuminate\Support\Facades\Route;

// Owner Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

// User Controllers
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\CityController as UserCityController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\CartController as UserCartController;
use App\Http\Controllers\User\CheckoutController as UserCheckoutController;


/*
|--------------------------------------------------------------------------
| Owner Authentication Routes
|--------------------------------------------------------------------------
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.store');

    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.store');

    Route::post('/logout', 'logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Restaurant Owner Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        // Dashboard
        Route::view('/dashboard', 'owner.dashboard')
            ->name('dashboard');

        // Restaurant Management
        Route::resource('restaurants', RestaurantController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        Route::post(
            '/restaurants/{id}/toggle-status',
            [RestaurantController::class, 'toggleStatus']
        )->name('restaurants.toggle-status');

        // Category Management
        Route::resource('categories', CategoryController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        Route::post(
            '/categories/{id}/toggle-status',
            [CategoryController::class, 'toggleStatus']
        )->name('categories.toggle-status');

        // Food Item Management
        Route::resource('items', ItemController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        Route::post(
            '/items/{id}/toggle-status',
            [ItemController::class, 'toggleStatus']
        )->name('items.toggle-status');
    });


/*
|--------------------------------------------------------------------------
| Public Home Route
|--------------------------------------------------------------------------
*/

Route::get('/', [UserHomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/

Route::controller(UserAuthController::class)
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/register', 'register')->name('register');
        Route::post('/logout', 'logout')->name('logout');
    });


/*
|--------------------------------------------------------------------------
| City Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user/cities')
    ->name('user.cities.')
    ->controller(UserCityController::class)
    ->group(function () {
        Route::get('/search', 'search')->name('search');
        Route::post('/select', 'select')->name('select');
    });


/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('/cart', [UserCartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add', [UserCartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update', [UserCartController::class, 'update'])
    ->name('cart.update');

Route::post('/cart/remove', [UserCartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/checkout', [UserCheckoutController::class, 'index'])
    ->name('checkout');
