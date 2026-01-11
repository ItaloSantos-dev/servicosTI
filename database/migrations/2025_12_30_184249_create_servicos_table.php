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
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('type_id');
            $table->text('description');
            $table->text('address');
            $table->enum('status', ['in_analysis', 'scheduled', 'completed', 'canceled'])->default('in_analysis');
            $table->dateTime('order_date'); //Data que fez o pedido
            $table->dateTime('scheduling_date')->nullable();//Data que vai ser feito o serviço, admin escolheu
            $table->dateTime('completion_date')->nullable();//Data de conclusão do serviço
            $table->dateTime('cancellation_date')->nullable();//Data de cancelamento
            $table->text('reason_for_cancellation')->nullable();//motivo do cancelamento
            $table->unsignedTinyInteger('rating')->nullable();
            $table->text('report');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('Order_types')->onDelete('cascade');
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
