<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLotsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('presentation_id')->unsigned();
            $table->integer('packager_id')->unsigned();
            $table->integer('quantity')->unsigned()->default(0);
            $table->date('production_date');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('presentation_id')->references('id')->on('presentations');
            $table->foreign('packager_id')->references('id')->on('packagers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lots');
    }
}
