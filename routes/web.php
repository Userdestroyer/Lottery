<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');

Route::prefix('/profile')->group(function () {
    Route::view('/', 'profile');
    Route::view('/info', 'info');
    Route::view('/my_tickets', 'my_tickets');
    Route::view('/cart', 'cart');
});

Route::prefix('/draws')->group(function () {
    Route::view('/', 'draws');
    Route::view('/draw', 'draw');
});

Route::prefix('/admin')->group(function () {
    Route::view('/', 'admin_dashboard');
});

Route::view('/wallet', 'wallet');

Route::view('/checkout', 'checkout');
