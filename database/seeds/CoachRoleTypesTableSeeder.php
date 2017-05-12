<?php

use Illuminate\Database\Seeder;

class CoachRoleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coach_role_types')->insert([
            [
                'name' => 'Nutrionist'
            ],
            [
                'name' => 'Power Trainer'
            ]
        ]);
    }
}
