<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('product_details')->nullable();
            $table->integer('qty')->nullable();
            $table->string('size')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->enum('delivery_status', ['pending', 'delivered', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])->nullable();
            $table->string('discount_type')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
