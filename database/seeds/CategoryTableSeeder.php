<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
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

        foreach (range(1, 35) as $index) {
            Category::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 10),
                'menu_id' => $faker->numberBetween($min = 1, $max = 5),
                'name' => $faker->department(6),
                'description' => $faker->realText(),
            ]);
        }
    }
}
