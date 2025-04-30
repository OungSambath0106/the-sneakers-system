<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN order_status ENUM(
            'pending',
            'preparing',
            'packed',
            'shipped',
            'ready_to_pickup',
            'completed',
            'cancelled'
        ) NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // If you want to revert to the old values
        DB::statement("ALTER TABLE orders MODIFY COLUMN order_status ENUM(
            'pending',
            'confirmed',
            'packaging',
            'out_for_delivery',
            'delivered',
            'failed_to_deliver',
            'cancelled',
            'preparing',
            'picked_up'
        ) NOT NULL DEFAULT 'pending'");
    }
};
