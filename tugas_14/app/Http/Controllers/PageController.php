<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Mengambil 4 produk unggulan beserta relasi kategorinya
        $featured_products = Product::with('category')->take(4)->get();
        return view('pages.home', compact('featured_products'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function cart()
    {
        return view('pages.cart');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }
}