<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'brand_id' => $faker->numberBetween($min = 1, $max = 10),
        'quantity' => $faker->numberBetween($min = 4, $max = 80),
        'price' => $faker->numberBetween($min = 500, $max = 5000),
        'name' => $faker->name,
        'description' => $faker->realText(),
        'image' => $faker->imageUrl(),
    ];
});
