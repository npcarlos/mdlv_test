<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvidersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('name');
            $table->integer('document_type_id')->unsigned();
            $table->string('document_number')->unique();
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('cellphone')->nullable()->unique();
            $table->string('web')->nullable()->unique();
            $table->string('facebook_id')->nullable()->unique();
            $table->string('instagram_id')->nullable()->unique();
            $table->string('slug');
            $table->string('image')->nullable();
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
        Schema::drop('providers');
    }
}
