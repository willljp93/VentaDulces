<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('featureds')->insert([
            [
                'name' => 'Paquete de dulces variados',
                'description' => 'Paquete con una selección de los dulces más populares de la tienda',
                'price' => 25.99,
                'rating' => 4,
                'discount' => 0,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Kit de decoración de cupcakes',
                'description' => 'Incluye todo lo necesario para decorar tus cupcakes como un profesional',
                'price' => 34.99,
                'rating' => 5,
                'discount' => 10,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Bolsa de caramelos de frutas',
                'description' => 'Caramelos con sabor a frutas naturales',
                'price' => 8.99,
                'rating' => 4,
                'discount' => 20,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Barra de chocolate artesanal',
                'description' => 'Chocolate hecho a mano con los mejores ingredientes',
                'price' => 12.99,
                'rating' => 5,
                'discount' => 5,
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'name' => 'Caja de bombones surtidos',
                'description' => 'Caja con una selección de bombones de diferentes sabores',
                'price' => 19.99,
                'rating' => 5,
                'discount' => 15,
                'image' => 'https://via.placeholder.com/150'
            ],
        ]);
    }
}
