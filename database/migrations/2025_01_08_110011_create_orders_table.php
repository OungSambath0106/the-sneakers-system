<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('order_amount')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_fee')->nullable();
            $table->enum('order_status', ['pending', 'confirmed', 'packaging', 'out_for_delivery', 'delivered', 'failed_to_deliver', 'cancelled'])->default('pending');
            $table->string('order_note')->nullable();
            $table->enum('payment_status', ['unpaid', 'paid'])->nullable();
            $table->enum('payment_method', ['cash_on_delivery', 'ABA', 'AC'])->nullable();
            $table->string('payment_image')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
