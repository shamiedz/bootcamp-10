<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar katalog produk (bisa difilter per kategori)
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        if ($kategori && $kategori !== 'all') {
            $products = Product::where('kategori', $kategori)->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products', 'kategori'));
    }

    // Menampilkan detail spesifik satu produk berdasarkan ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}