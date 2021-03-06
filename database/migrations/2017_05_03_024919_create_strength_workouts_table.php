<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrengthWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strength_workouts', function (Blueprint $table) {
            $table->increments('strength_workout_id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->float('weight');
            $table->integer('reps');
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
        Schema::dropIfExists('strength_workouts');
    }
}