<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplyOrderItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('supply_order_id')->unsigned();
            $table->integer('supply_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_order_id')->references('id')->on('supply_orders');
            $table->foreign('supply_id')->references('id')->on('supplies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supply_order_items');
    }
}
