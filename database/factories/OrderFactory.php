<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween($min = 4, $max = 80),
        'qty' => $faker->numberBetween($min = 4, $max = 80),
        'total_price' => $faker->numberBetween($min = 2000, $max = 9000),
    ];
});
