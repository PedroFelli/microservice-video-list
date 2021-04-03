<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Genre;
use Faker\Generator as Faker;

$factory->define(\App\Models\Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    ];
});
