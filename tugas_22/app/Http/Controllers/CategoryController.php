<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori produk.
     */
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan formulir tambah kategori produk.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan data kategori baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ], [
            'name.required' => 'The category name field is required.',
            'name.unique'   => 'This category name already exists.',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Product category created successfully!');
    }

    /**
     * Menampilkan detail spesifik kategori.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Menampilkan halaman edit kategori berdasarkan ID (Tugas 22).
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Memvalidasi input dan memperbarui data kategori di database (Tugas 22).
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'The category name field is required.',
            'name.unique'   => 'This category name already exists.',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Product category updated successfully!');
    }

    /**
     * Menghapus data kategori berdasarkan ID (Tugas 22).
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Product category deleted successfully!');
    }
}