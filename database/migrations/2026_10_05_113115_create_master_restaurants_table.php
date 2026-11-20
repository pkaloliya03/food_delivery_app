<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_restaurants', function (Blueprint $table) {
            $table->id();

            // Restaurant Owner
            $table->foreignId('owner_id')
                ->constrained('master_users')
                ->cascadeOnDelete();

            // Basic Information
            $table->string('name', 150);
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();

            // Contact
            $table->string('mobile', 20)->nullable();

            // Location
            $table->foreignId('city_id')
                ->constrained('master_cities')
                ->restrictOnDelete();

            $table->text('address')->nullable();

            // Restaurant Timing
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();

            // Useful indexes
            $table->index('owner_id');
            $table->index('city_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_restaurants');
    }
};
