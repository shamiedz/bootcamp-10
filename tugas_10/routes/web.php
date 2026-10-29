<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// 1. Route Beranda (/)
Route::get('/', function () {
    return view('welcome');
});

// 2. Route /products (Memanggil ProductController)
Route::get('/products', [ProductController::class, 'index']);

// 3. Route /cart
Route::get('/cart', function () {
    return response()->json([
        'status'  => 'success',
        'message' => 'Halaman Keranjang Belanja (Cart)'
    ]);
});

// 4. Route /checkout (Memanggil OrderController)
Route::get('/checkout', [OrderController::class, 'checkout']);