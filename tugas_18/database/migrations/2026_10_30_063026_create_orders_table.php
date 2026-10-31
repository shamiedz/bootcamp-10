<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // id[cite: 4]
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // user_id[cite: 4]
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete(); // product_id[cite: 4]
            $table->integer('quantity'); // quantity[cite: 4]
            $table->decimal('total', 12, 2); // total[cite: 4]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
