<?php

use Faker\Generator as Faker;

$factory->define(\App\Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'phone_number' => $faker->phoneNumber,
        'joined_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
