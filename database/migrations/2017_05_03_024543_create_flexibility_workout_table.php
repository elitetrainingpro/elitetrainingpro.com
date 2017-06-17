<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlexibilityWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flexibility_workout', function (Blueprint $table) {
            $table->increments('flexibility_workout_id');
            $table->integer('workout_id')->unsigned();
            $table->string('name');
            $table->decimal('time', 3, 2);
            $table->text('notes');
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
        Schema::dropIfExists('endurance_workout');
    }
}
