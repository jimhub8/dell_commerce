<?php

use Faker\Generator as Faker;

$factory->define(App\SupCategory::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'name' => $faker->name,
    ];
});
