<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori produk.
     */
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan formulir tambah kategori produk (Tugas 21).
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Memvalidasi input dan menyimpan kategori ke database (Tugas 21).
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
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Menampilkan formulir edit kategori.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori produk.
     */
    public function update(Request $request, Category $category)
    {
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
     * Menghapus kategori produk.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Product category deleted successfully!');
    }
}