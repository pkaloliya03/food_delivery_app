<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('restaurant_id')
                ->constrained('master_restaurants')
                ->cascadeOnDelete();

            $table->string('name', 150);
            $table->text('description')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();

            // Same category name cannot be repeated
            // inside the same restaurant.
            $table->unique(['restaurant_id', 'name']);

            $table->index('restaurant_id');
            $table->index('status');
            $table->index(['restaurant_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_categories');
    }
};
