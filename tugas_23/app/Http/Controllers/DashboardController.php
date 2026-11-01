<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalClicks     = Product::sum('klik'); // Menggunakan kolom 'klik' sesuai instruksi

        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalClicks'));
    }
}