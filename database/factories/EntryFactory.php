<?php

/*
|--------------------------------------------------------------------------
| Entry Factory
|--------------------------------------------------------------------------
|
| Defining an automatically seeding factory for a entry model. Foreign keys
| fave to be delivered from existing data, otherwise a factory will be
| started.
|
*/

use App\Entry;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Entry::class, function (Generator $faker) {
    return [
        'title' => $faker->sentence,
        'identifier' => $faker->word,
        'year' => $faker->numberBetween(0, 2000),
        'author_id' => DB::table('authors')->inRandomOrder()->first()->id,
        'genre_id' => DB::table('genres')->inRandomOrder()->first()->id
    ];
});
