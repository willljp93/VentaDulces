<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promotions')->insert([
            [
                'title' => 'Descuento en dulces',
                'description' => '¡Compra 3 paquetes de dulces y obtén el siguiente al 50% de descuento!',
                'discount' => 50,
                'expires' => Carbon::createFromFormat('Y-m-d', '2023-12-28')->format('Y-m-d'),
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'title' => 'Oferta en cakes',
                'description' => '¡Todos los cakes a mitad de precio hasta fin de mes!',
                'discount' => 50,
                'expires' => Carbon::createFromFormat('Y-m-d', '2023-12-10')->format('Y-m-d'),

                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'title' => 'Promoción en flanes',
                'description' => '¡Compra 2 flanes y lleva el tercero gratis!',
                'discount' => 100,
                'expires' => Carbon::createFromFormat('Y-m-d', '2023-11-30')->format('Y-m-d'),
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'title' => 'Descuento en panes',
                'description' => '¡Compra 4 panes y obtén el quinto gratis!',
                'discount' => 100,
                'expires' => Carbon::createFromFormat('Y-m-d', '2023-08-15')->format('Y-m-d'),
                'image' => 'https://via.placeholder.com/150'
            ],
            [
                'title' => 'Oferta en paquetes surtidos',
                'description' => '¡Compra un paquete surtido de dulces, cakes, flanes y panes con un 20% de descuento!',
                'discount' => 20,
                'expires' => Carbon::createFromFormat('Y-m-d', '2023-09-09')->format('Y-m-d'),
                'image' => 'https://via.placeholder.com/150'
            ],
        ]);
    }
}