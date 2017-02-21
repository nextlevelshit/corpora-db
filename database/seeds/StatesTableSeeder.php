<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    private $states = array('raw',
                            'normalisiert 1',
                            'normalisiert 2',
                            'pos-tagged',
                            'annotiert',
                            'freestyle');

    /**
    * Run the database seed for authors with a random name and year of birth
    *
    * @return void
    */
    public function run()
    {
        foreach ($this->states as $state) {
            DB::table('states')->insert([
                'title' => $state
            ]);
        }
    }
}
