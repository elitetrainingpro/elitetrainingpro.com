<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrengthGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('strength_goals', function (Blueprint $table) {
    		$table->increments('strength_workout_id');
    		$table->integer('user_id')->unsigned();
    		$table->string('goal_type');
    		$table->string('name');
    		$table->float('weight');
    		$table->integer('reps');
    		$table->integer('sets');
    		$table->dateTimeTz('date');
    		$table->float('percent');
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
    	Schema::dropIfExists('strength_goals');
    }
}
