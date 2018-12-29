<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('seller_id')->unsigned();
            $table->integer('payment_status_id')->unsigned();
            $table->integer('delivery_status_id')->unsigned();
            $table->integer('deliverer_id')->unsigned();
            $table->date('planned_delivery_date')->nullable();
            $table->datetime('delivery_date')->nullable();
            $table->integer('delivery_address_id')->unsigned();
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses');
            $table->foreign('delivery_status_id')->references('id')->on('delivery_statuses');
            $table->foreign('deliverer_id')->references('id')->on('deliverers');
            $table->foreign('delivery_address_id')->references('id')->on('delivery_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
