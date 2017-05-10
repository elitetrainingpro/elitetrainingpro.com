<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrengthWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strength_workout', function (Blueprint $table) {
            $table->increments('strength_workout_id');
            $table->integer('workout_id')->unsigned();
            $table->string('name');
            $table->decimal('weight', 3, 2);
            $table->integer('reps');
            $table->integer('sets');
            $table->dateTimeTz('date');
            $table->foreign('workout_id')->references('workout_id')->on('workout');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strength_workout');
    }
}