<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->upsert([
            [
                'id' => 1,
                'category_id' => 1,
                'name' => 'Wireless Noise-Canceling Headphone',
                'description' => 'Wireless headphones with a 30-hour battery life and premium ANC.',
                'price' => 1450000,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'name' => 'Smartwatch AMOLED Pro',
                'description' => 'Sporty smartwatch with a heart rate sensor and AMOLED display.',
                'price' => 2199000,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'category_id' => 2,
                'name' => 'Parka Outdoor Jacket Waterproof',
                'description' => 'Thick, windproof Taslan jacket for outdoor adventure.',
                'price' => 485000,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=600',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'category_id' => 2,
                'name' => 'Sneakers Classic White',
                'description' => 'Minimalist canvas shoes with cushion insole for daily comfort.',
                'price' => 650000,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'category_id' => 1,
                'name' => 'Processor Ryzen 7 5900X3D',
                'description' => 'High performance CPU for gaming and heavy productivity.',
                'price' => 7099000,
                'stock' => 8,
                'image' => 'uploads/1793268372_ryzen9700x3d.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['name', 'category_id', 'description', 'price', 'stock', 'image', 'updated_at']);
    }
}