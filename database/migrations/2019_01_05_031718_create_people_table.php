<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('name');
            $table->string('lastname');
            $table->date('birthday')->nullable();
            $table->string('email');
            $table->string('password');
            $table->integer('document_type_id')->unsigned();
            $table->string('document_number');
            $table->string('phone')->nullable()->unique();
            $table->string('cellphone')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('pictureLarge');
            $table->string('pictureMedium');
            $table->string('pictureThumbnail');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('document_type_id')->references('id')->on('document_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people');
    }
}
