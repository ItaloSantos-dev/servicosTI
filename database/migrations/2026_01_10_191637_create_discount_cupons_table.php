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
        Schema::create('discount_cupons', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 10);
            $table->integer('amount');
            $table->boolean('active');
            $table->decimal('minimum_amount', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_cupons');
    }
};
