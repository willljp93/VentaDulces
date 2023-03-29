<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatReposteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 15; $i++) {
            DB::table('cat_reposterias')->insert([
                'title' => $faker->word(),
                'description' => $faker->sentence(),
                'image' => 'src\assets\reposteria.jpg',
                'price' => $faker->numberBetween(10, 100),
                'available' => $faker->boolean(),
                'rating' => $faker->numberBetween(1, 5),
                'discount' => $faker->optional()->numberBetween(5, 50),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
