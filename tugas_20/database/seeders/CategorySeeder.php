<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->upsert([
            ['id' => 1, 'name' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Fashion', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Aksesoris', 'created_at' => now(), 'updated_at' => now()],
        ], ['id'], ['name', 'updated_at']);
    }
}