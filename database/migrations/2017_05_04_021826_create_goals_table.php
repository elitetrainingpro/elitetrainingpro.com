<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('goal_id');
            $table->integer('user_id')->unsigned();
            $table->integer('goal_type_id')->unsigned();
            $table->integer('goal_interval_id')->unsigned();
            $table->string('name');
            $table->text('notes');
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('end_date');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('goal_type_id')->references('goal_type_id')->on('goal_types');
            $table->foreign('goal_interval_id')->references('goal_interval_id')->on('goal_interval');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
