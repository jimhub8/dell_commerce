<?php

use Faker\Generator as Faker;

$factory->define(App\models\Variant::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'title' => $faker->name,
    ];
});
