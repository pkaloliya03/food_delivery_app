<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_users', function (Blueprint $table) {
            $table->id();

            $table->string('username', 100)->unique();
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('mobile', 20)->nullable();

            $table->enum('role', [
                'admin',
                'restaurant_owner',
                'customer',
                'delivery_boy'
            ])->default('customer');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_users');
    }
};
