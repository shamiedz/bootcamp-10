<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// 1. Halaman Beranda (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// 2. Rute Dashboard & Fitur Admin (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // Mengambil data metrik ringkasan untuk Tugas 18
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalClicks = Product::sum('clicks');

        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalClicks'));
    })->name('dashboard');

    // Rute Kategori & Produk
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Profil Akun Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Rute Autentikasi Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';