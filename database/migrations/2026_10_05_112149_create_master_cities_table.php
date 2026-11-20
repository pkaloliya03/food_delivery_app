<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_cities', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);
            $table->string('state', 100);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique(['name', 'state']);
            $table->index('name');
            $table->index('state');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_cities');
    }
};
