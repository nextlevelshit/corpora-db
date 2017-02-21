<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    private $genres = array('Lyrik',
                            'Epik',
                            'Drama');

    /**
    * Run the database seed for authors with a random name and year of birth
    *
    * @return void
    */
    public function run()
    {
        foreach ($this->genres as $genre) {
            DB::table('genres')->insert([
                'title' => $genre
            ]);
        }
    }
}
