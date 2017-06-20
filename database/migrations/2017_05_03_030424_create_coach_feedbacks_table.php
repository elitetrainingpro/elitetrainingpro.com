<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_feedbacks', function (Blueprint $table) {
            $table->increments('coach_feedback_id');
            $table->integer('athlete_to_coach_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->integer('note_type_id')->unsigned();
            $table->text('notes');
            $table->boolean('is_read');
            $table->boolean('is-deleted');
            $table->dateTimeTz('date');
            $table->foreign('athlete_to_coach_id')->references('athlete_to_coach_id')->on('athlete_to_coaches');
            $table->foreign('coach_id')->references('id')->on('users');
            $table->foreign('note_type_id')->references('note_type_id')->on('note_types');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coach_feedbacks');
    }
}
