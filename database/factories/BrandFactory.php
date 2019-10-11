<?php

// use Bezhanov\Faker\Provider\Device;

// use Faker\Generator as Faker;
$faker = \Faker\Factory::create();
$faker->addProvider(new Bezhanov\Faker\Provider\Space($faker));
// \Bezhanov\Faker
// $factory->define(App\Brand::class, function (Faker $faker) {
//     return [
//         'user_id' => $faker->numberBetween($min = 1, $max = 10),
//         'category_id' => $faker->numberBetween($min = 1, $max = 10),
//         'name' => $faker->medicine,
//         'description' => $faker->realText(),
//     ];
// });
$faker->planet;
