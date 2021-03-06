<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('balance_goals', function (Blueprint $table) {
    		$table->increments('balance_workout_id');
    		$table->integer('user_id')->unsigned();
    		$table->string('goal_type');
    		$table->string('name');
    		$table->float('time');
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
    	Schema::dropIfExists('balance_goals');
    }
}
