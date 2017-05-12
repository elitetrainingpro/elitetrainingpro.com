<?php

use Illuminate\Database\Seeder;

class GoalTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goal_types')->insert([
            [
                'name' => 'Balance'
            ],
            [
                'name' => 'Endurance'
            ],
            [
                'name' => 'Flexibility'
            ],
            [
                'name' => 'Strength'
            ]
        ]);
        
    }
}
