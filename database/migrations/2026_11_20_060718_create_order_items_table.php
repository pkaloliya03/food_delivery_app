<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Parent Order
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Original Food Item
            $table->foreignId('item_id')
                ->nullable()
                ->constrained('master_items')
                ->nullOnDelete();

            // Item Snapshot
            $table->string('item_name');
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('total', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
