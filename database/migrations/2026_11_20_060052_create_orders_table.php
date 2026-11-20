<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Order Information
            $table->string('order_no')->unique();

            // Customer Information
            $table->foreignId('customer_id')
                ->constrained('master_users')
                ->restrictOnDelete();

            $table->string('username');
            $table->string('customer_name');
            $table->string('mobile', 15);

            // Restaurant Information
            $table->foreignId('restaurant_id')
                ->constrained('master_restaurants')
                ->restrictOnDelete();

            // Delivery Information
            $table->text('address');
            $table->string('city');
            $table->string('pincode', 10);
            $table->text('instructions')->nullable();

            // Amount Information
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('delivery_charge', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            // Order Status
            $table->string('status')->default('pending');

            $table->timestamps();

            $table->index(['restaurant_id', 'status']);
            $table->index(['customer_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
