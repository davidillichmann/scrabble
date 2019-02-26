<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'location' => $faker->city,
        'date' => $faker->dateTimeBetween('-20 years','now'),
    ];
});
