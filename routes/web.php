<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;      // ← added

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group 
| which contains the "web" middleware group. Now create something great!
|
*/

// Public home
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (already protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Protected CRUD and cart routes
Route::middleware('auth')->group(function () {
    // Category & Product CRUD
    Route::resource('categories', CategoryController::class);
    Route::resource('products',   ProductController::class);

    // Shopping cart
    Route::get   ('cart',               [CartController::class, 'index']) ->name('cart.index');
    Route::post  ('cart/add/{product}', [CartController::class, 'add'])   ->name('cart.add');
    Route::patch ('cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout: create an order from the cart
    Route::post('checkout', [OrderController::class, 'checkout'])
         ->name('checkout');

    // Show a placed order
    Route::get('orders/{order}', [OrderController::class, 'show'])
         ->name('orders.show');
});

// Breeze authentication routes
require __DIR__.'/auth.php';


