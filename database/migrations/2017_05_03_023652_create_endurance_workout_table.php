<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnduranceWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endurance_workout', function (Blueprint $table) {
            $table->increments('endurance_workout_id');
            $table->integer('workout_id')->unsigned();
            $table->string('name');
            $table->decimal('distance', 3, 2);
            $table->decimal('event_time', 3, 2);
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
        Schema::dropIfExists('endurance_workout');
    }
}
