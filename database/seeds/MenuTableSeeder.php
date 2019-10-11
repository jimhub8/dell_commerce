<?php

use Illuminate\Database\Seeder;
use App\menu;

class MenuTableSeeder extends Seeder
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
        foreach (range(1, 4) as $index) {
            menu::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 10),
                'name' => $faker->department(6),
            ]);
        }
    }
}
