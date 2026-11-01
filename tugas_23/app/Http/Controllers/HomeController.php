<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan katalog produk dan kategori di halaman depan
     */
    public function index(Request $request)
    {
        // Mengambil semua kategori beserta jumlah produknya
        $categories = Category::withCount('products')->get();

        // Query produk beserta relasi kategorinya
        $query = Product::with('category');

        // Filter produk berdasarkan kategori jika dipilih pengunjung
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Ambil produk terbaru
        $products = $query->latest()->get();

        return view('welcome', compact('categories', 'products'));
    }
}