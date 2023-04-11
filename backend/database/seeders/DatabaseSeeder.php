<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FeaturedSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(CatDecoracioneSeeder::class);
        $this->call(CatFlaneSeeder::class);
        $this->call(CatPanaderiaSeeder::class);
        $this->call(CatPasteleSeeder::class);
        $this->call(CatReposteriaSeeder::class);
    }
}
