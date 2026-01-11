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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('discount_coupon_id')->nullable();//valor a ser dividio por cem
            $table->decimal('discount', 10, 2)->default(0);//valor para desconto
            $table->decimal('additional_fee', 10, 2)->default(0);//valor adicional
            $table->decimal('final_amount', 10, 2);//valor final após descontos e acréscimos

            $table->string('payment_method', 50);
            $table->string('invoice_number')->nullable();
            $table->string('payment_status', 30);

            $table->timestamp('paid_at')->nullable();

            $table->foreign('discount_coupon_id')->references('id')->on('discount_cupons')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
