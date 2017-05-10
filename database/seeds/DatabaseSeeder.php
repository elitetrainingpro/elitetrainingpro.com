<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(GoalTypesTableSeeder::class);
    	$this->call(NoteTypesTableSeeder::class);
    	$this->call(RolesTableSeeder::class);
    	$this->call(CoachRoleTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
