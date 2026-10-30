<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Product::with('category');

        if ($kategori && $kategori !== 'all') {
            $query->whereHas('category', function ($q) use ($kategori) {
                $q->where('name', 'like', "%{$kategori}%");
            });
        }

        $products = $query->get();

        return view('products.index', compact('products', 'kategori'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}