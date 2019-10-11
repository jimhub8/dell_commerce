<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new Bezhanov\Faker\Provider\Medicine($faker));
        foreach (range(1, 3) as $index) {
            Brand::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 10),
                'category_id' => $faker->numberBetween($min = 1, $max = 10),
                'name' => $faker->medicine,
                'description' => $faker->realText(),
            ]);
        }
    }
}
