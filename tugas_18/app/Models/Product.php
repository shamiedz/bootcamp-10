<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'stock',
        'description',
        'image',
        'clicks',
    ];

    // Relasi: Setiap Produk dimiliki oleh satu Kategori (Inverse One-to-Many)
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}