<?php

use Illuminate\Database\Seeder;
use App\Author;

class EntriesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $authors = Author::all();

        factory('App\Entry', 2000)->create()->each(function ($entry) use ($authors) {
            $entry->author()->attach(
                $authors->random(1, 3)->pluck('id')->toArray()
            );
        });
    }
}
