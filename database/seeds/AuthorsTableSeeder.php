<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
    * Run the database seed for authors with a random name and year of birth
    *
    * @return void
    */
    public function run()
    {
        DB::table('authors')->insert([
            'name' => str_random(10).' '.str_random(12),
            'year' => rand(0, 2000)
        ]);
    }
}
