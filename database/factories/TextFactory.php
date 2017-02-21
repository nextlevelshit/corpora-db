<?php

/*
|--------------------------------------------------------------------------
| Text Factory
|--------------------------------------------------------------------------
|
| Defining an automatically seeding factory for a text model. Foreign keys
| have to be delivered from existing data, otherwise a seeder will be
| started.
|
*/

use App\Text;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Text::class, function (Generator $faker) {
    return [
        'entry_id' => DB::table('entries')->inRandomOrder()->first()->id,
        'path' => $faker->sha256().'.txt',
        'state_id' => DB::table('states')->inRandomOrder()->first()->id
    ];
});
