<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public Storefront / Display Page via Controller
Route::get('/', [HomeController::class, 'index'])->name('home');

// Area Khusus Admin (Dilindungi Middleware auth, verified, dan admin)
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    // Rute Dashboard menggunakan DashboardController sesuai instruksi Tugas 23
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute resource penamaan spesifik Tugas 21
    Route::resource('product-category', CategoryController::class)->names('product-category');
    Route::resource('product', ProductController::class)->names('product');

    // Rute resource bawaan (kompatibilitas link index/edit)
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