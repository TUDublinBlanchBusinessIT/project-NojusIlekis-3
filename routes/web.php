<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;  // ← added

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protected, now using DashboardController)
Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth'])
     ->name('dashboard');

// Protected CRUD and cart routes
Route::middleware('auth')->group(function () {
    // Category & Product CRUD
    Route::resource('categories', CategoryController::class);
    Route::resource('products',   ProductController::class);

    // Shopping cart
    Route::get   ('cart',                 [CartController::class, 'index'])   ->name('cart.index');
    Route::post  ('cart/add/{product}',   [CartController::class, 'add'])     ->name('cart.add');
    Route::patch ('cart/update/{product}',[CartController::class, 'update'])  ->name('cart.update');
    Route::delete('cart/remove/{product}',[CartController::class, 'remove'])  ->name('cart.remove');

    // Checkout: create an order from the cart
    Route::post('checkout', [OrderController::class, 'checkout'])
         ->name('checkout');

    // Show a placed order
    Route::get('orders/{order}', [OrderController::class, 'show'])
         ->name('orders.show');

    // Order history
    Route::get('orders', [OrderController::class, 'index'])
         ->name('orders.index');

    // Rate an order
    Route::post('orders/{order}/rate', [OrderController::class, 'rate'])
         ->name('orders.rate');
});

// Breeze authentication routes
require __DIR__.'/auth.php';



