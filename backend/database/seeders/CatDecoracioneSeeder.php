<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatDecoracioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 15; $i++) {
            DB::table('cat_decoraciones')->insert([
                'title' => $faker->word(),
                'description' => $faker->sentence(),
                'image' => 'src\assets\decoraciones.jpg',
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
