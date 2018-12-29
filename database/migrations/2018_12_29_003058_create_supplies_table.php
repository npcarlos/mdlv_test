<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supply_category_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->integer('provider_id')->unsigned();
            $table->double('measurement_quantity');
            $table->integer('measurement_unit_id')->unsigned();
            $table->integer('minimum_stock_quantity')->default(0);
            $table->integer('stock_quantity')->unsigned()->default(0);
            $table->integer('minimum_quantity')->unsigned()->default(0);
            $table->double('unitary_value')->default(0);
            $table->double('iva')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_category_id')->references('id')->on('supply_categories');
            $table->foreign('provider_id')->references('id')->on('providers');
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
        Schema::drop('supplies');
    }
}
