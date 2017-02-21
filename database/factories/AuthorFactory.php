<?php

/*
|--------------------------------------------------------------------------
| Author Factory
|--------------------------------------------------------------------------
|
| Defining an automatically seeding factory for a author model
|
*/

use App\Author;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Author::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'year' => $faker->numberBetween(0, 2000)
    ];
});
