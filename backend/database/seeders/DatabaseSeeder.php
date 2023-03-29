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
        $this->call(FeaturedsSeeder::class);
        $this->call(PromotionsSeeder::class);
        $this->call(TestimonialsSeeder::class);
        $this->call(CatDecoracionesSeeder::class);
        $this->call(CatFlanesSeeder::class);
        $this->call(CatPanaderiaSeeder::class);
        $this->call(CatPastelesSeeder::class);
        $this->call(CatReposteriaSeeder::class);
    }
}
