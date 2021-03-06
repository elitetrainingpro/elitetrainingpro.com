<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlexibilityWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flexibility_workouts', function (Blueprint $table) {
            $table->increments('flexibility_workout_id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->float('time');
            $table->integer('sets');
            $table->dateTimeTz('date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endurance_workouts');
    }
}
