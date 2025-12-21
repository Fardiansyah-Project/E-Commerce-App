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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_no')->unique();
            $table->decimal('total_amount', 12, 2);
            $table->text('shipping_address');
            $table->enum('payment_method', ['TRANSFER', 'COD']);
            $table->enum('payment_status', ['PENDING', 'CONFIRMED'])->default('PENDING');
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['PENDING', 'PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
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
