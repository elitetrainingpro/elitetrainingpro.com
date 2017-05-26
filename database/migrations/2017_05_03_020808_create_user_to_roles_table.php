<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_to_roles', function (Blueprint $table) {
            $table->increments('user_to_roles_id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('coach_role_type_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('coach_role_type_id')->references('coach_role_type_id')->on('coach_role_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_to_roles');
    }
}
