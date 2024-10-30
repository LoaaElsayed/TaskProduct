<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * cartid,totalprice,couponid,status,finaltotal
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('finaltotal', 10, 2)->default(0);
            $table->enum('status',['pending','compelete'])->default('pending');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
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
