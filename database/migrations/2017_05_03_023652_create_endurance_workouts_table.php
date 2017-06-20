<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnduranceWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endurance_workouts', function (Blueprint $table) {
            $table->increments('endurance_workout_id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->float('distance');
            $table->float('event_time');
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
