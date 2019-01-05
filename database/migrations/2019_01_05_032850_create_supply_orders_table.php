<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupplyOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('provider_id')->unsigned();
            $table->integer('administrator_id')->unsigned();
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('administrator_id')->references('id')->on('administrators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supply_orders');
    }
}
