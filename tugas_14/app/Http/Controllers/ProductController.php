<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        // Query relasi ke ProductCategory
        $query = Product::with('category');

        // Filter kategori jika ada parameter query
        if ($kategori && $kategori !== 'all') {
            $query->whereHas('category', function ($q) use ($kategori) {
                $q->where('name', 'like', "%{$kategori}%");
            });
        }

        // KUNCI TUGAS 14: Batasi 4 produk per halaman menggunakan paginate()
        $products = $query->paginate(4);

        return view('products.index', compact('products', 'kategori'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}