<?php

use Faker\Generator as Faker;

$factory->define(App\Csvdata::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'registration_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
    ];
});
