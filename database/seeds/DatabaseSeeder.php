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
        $this->call(StatesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(EntriesTableSeeder::class);
        $this->call(TextsTableSeeder::class);
    }
}
