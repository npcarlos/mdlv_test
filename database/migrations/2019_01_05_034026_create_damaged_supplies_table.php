<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDamagedSuppliesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damaged_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('supply_id')->unsigned();
            $table->integer('prelot_order_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->text('damage_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_id')->references('id')->on('supplies');
            $table->foreign('prelot_order_id')->references('id')->on('prelot_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('damaged_supplies');
    }
}
