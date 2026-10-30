<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Menghubungkan ke tabel categories di database bc10_tugas13
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    // Relasi: Satu Kategori memiliki banyak Produk (One-to-Many)
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}