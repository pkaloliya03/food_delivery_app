<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')
                ->constrained('master_restaurants')
                ->cascadeOnDelete();
            $table->foreignId('category_id')
                ->constrained('master_categories')
                ->restrictOnDelete();
            $table->string('name', 150);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_veg')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index('restaurant_id');
            $table->index('category_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_items');
    }
};
