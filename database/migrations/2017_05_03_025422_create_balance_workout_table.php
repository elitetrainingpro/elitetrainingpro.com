<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceWorkoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_workout', function (Blueprint $table) {
            $table->increments('balance_workout_id');
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
        Schema::dropIfExists('balance_workout');
    }
}
