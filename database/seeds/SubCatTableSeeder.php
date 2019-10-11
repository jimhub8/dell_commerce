<?php

use Illuminate\Database\Seeder;
use App\SupCategory;

class SubCatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

        foreach (range(1, 400) as $index) {
            SupCategory::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 4),
                'category_id' => $faker->numberBetween($min = 30, $max = 68),
                'name' => $faker->department,
                // 'description' => $faker->realText(),
            ]);
        }
    }
}
