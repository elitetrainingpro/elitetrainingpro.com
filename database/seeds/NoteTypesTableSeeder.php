<?php

use Illuminate\Database\Seeder;

class NoteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('note_types')->insert([
            [
                'name' => 'Medical'
            ],
            [
                'name' => 'Training'
            ],
            [
                'name' => 'Nutrition'
            ]
        ]);
    }
}
