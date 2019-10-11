<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'product_id' => $faker->numberBetween($min = 1, $max = 5),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'comments' => $faker->realText(),
    ];
});
