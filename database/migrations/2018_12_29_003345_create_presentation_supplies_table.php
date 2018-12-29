<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresentationSuppliesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presentation_id')->unsigned();
            $table->integer('supply_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('presentation_id')->references('id')->on('presentations');
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
        Schema::drop('presentation_supplies');
    }
}
