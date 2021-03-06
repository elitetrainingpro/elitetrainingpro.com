<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAthleteToCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_to_coaches', function (Blueprint $table) {
            $table->increments('athlete_to_coach_id');
            $table->integer('athlete_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->boolean('still_connected');
            $table->timestamps();
            $table->foreign('athlete_id')->references('id')->on('users');
            $table->foreign('coach_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athlete_to_coaches');
    }
}
