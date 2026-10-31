<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // withCount('products') otomatis menghitung jumlah relasi produk untuk kolom 'jumlah produk'
        $categories = Category::withCount('products')->get();
        return view('categories.index', compact('categories'));
    }

    // Method dummy agar tombol tambah/edit tidak error saat diklik
    public function create() { return back(); }
    public function edit($id) { return back(); }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}