<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

// Protected CRUD routes
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products',   ProductController::class);
});

// Breeze authentication routes
require __DIR__.'/auth.php';

