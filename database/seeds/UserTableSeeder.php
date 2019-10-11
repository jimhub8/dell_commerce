<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 1) as $index) {
            User::create([
                'name' => 'Jimmy Kiarie', 
                'email' => 'jimlaravel@gmail.com', 
                'email_verified_at' => now(), 
                'password' => '$2y$10$a40e5q1tdmFEwOhh3KwiweblRxB1ZmCEAb8Fb3E/sq7LYggnpWIrW',  // password
                'company_id' => $faker->numberBetween($min = 1, $max = 5),
            ]);
        }
    }
}
