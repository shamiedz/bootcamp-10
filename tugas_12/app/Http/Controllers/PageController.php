<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Halaman Beranda / Home (Menampilkan banner & preview produk unggulan)
    public function home()
    {
        $featured_products = Product::take(4)->get();
        return view('pages.home', compact('featured_products'));
    }

    // Halaman Tentang Toko / About
    public function about()
    {
        return view('pages.about');
    }

    // Halaman Keranjang Belanja / Cart
    public function cart()
    {
        return view('pages.cart');
    }
}