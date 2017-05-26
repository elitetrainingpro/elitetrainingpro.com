<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'William Montesdeoca',
                'email' => 'wvmon360@gmail.com',
                'password' => bcrypt('secret'),
                'image' => str_random(10),
                'needs_password_reset' => 0,
                'user_guide' => 'dzei2equvrhi5og4',
                'is_coach' => 0
            ],
            [
                'name' => 'Hunter Marshall',
                'email' => 'hjmarshall18@gmail.com',
                'password' => bcrypt('secret'),
                'image' => str_random(10),
                'needs_password_reset' => 0,
                'user_guide' => 'dzei2equvrhi5og5',
                'is_coach' => 0
            ]
        ]);
    }
}
