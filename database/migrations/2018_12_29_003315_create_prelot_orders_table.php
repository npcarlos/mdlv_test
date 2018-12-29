<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrelotOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prelot_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presentation_id')->unsigned();
            $table->integer('packager_id')->unsigned();
            $table->integer('prelot_status_id')->unsigned();
            $table->integer('requested_quantity')->default(0);
            $table->integer('real_quantity')->default(0);
            $table->datetime('planned_packaging_date')->nullable();
            $table->datetime('packaged_date')->nullable();
            $table->text('comments');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('presentation_id')->references('id')->on('presentations');
            $table->foreign('packager_id')->references('id')->on('packagers');
            $table->foreign('prelot_status_id')->references('id')->on('prelot_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prelot_orders');
    }
}
