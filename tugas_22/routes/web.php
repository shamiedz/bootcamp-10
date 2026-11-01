<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Public Storefront / Display Page via Controller
Route::get('/', [HomeController::class, 'index'])->name('home');

// Area Khusus Admin (Dilindungi Middleware auth, verified, dan admin)
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalClicks = Product::sum('clicks');

        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalClicks'));
    })->name('dashboard');

    // Rute resource sesuai penamaan spesifik Tugas 21
    Route::resource('product-category', CategoryController::class)->names('product-category');
    Route::resource('product', ProductController::class)->names('product');

    // Rute resource lama (agar tombol navigasi index/edit yang sudah ada tetap aman)
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

// User Profile Area
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';