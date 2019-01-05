<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresentationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('product_id')->unsigned();
            $table->string('slug');
            $table->string('short_name');
            $table->string('formal_name');
            $table->double('measurement_quantity');
            $table->integer('measurement_unit_id')->unsigned();
            $table->double('wholesale_price');
            $table->double('retail_price');
            $table->integer('minimum_stock_quantity')->unsigned()->default(0);
            $table->double('iva')->default(0);
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('presentations');
    }
}
