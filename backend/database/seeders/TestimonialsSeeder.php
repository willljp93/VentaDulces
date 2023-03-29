<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'avatar' => 'https://via.placeholder.com/150',
                'name' => 'María Pérez',
                'text' => 'Los dulces de esta tienda son los mejores que he probado. Siempre tienen una gran variedad de sabores y texturas. ¡Los recomiendo!',
                'rating' => 5,
            ],
            [
                'avatar' => 'https://via.placeholder.com/150',
                'name' => 'Juan Sánchez',
                'text' => 'Los cakes de esta tienda son deliciosos. Los pedí para mi cumpleaños y todos mis invitados quedaron encantados. Además, el servicio al cliente es excelente.',
                'rating' => 4,
            ],
            [
                'avatar' => 'https://via.placeholder.com/150',
                'name' => 'Ana Torres',
                'text' => 'Los flanes de esta tienda son increíbles. Siempre los pido para mis cenas y todos mis amigos quedan impresionados. ¡No puedo esperar para probar los panes!',
                'rating' => 5,
            ],
            [
                'avatar' => 'https://via.placeholder.com/150',
                'name' => 'Pedro Gómez',
                'text' => 'Compré algunos dulces y panes para regalar en Navidad y fueron todo un éxito. Mis familiares y amigos quedaron encantados con la calidad y el sabor. Definitivamente volveré a comprar aquí.',
                'rating' => 4,
            ],
            [
                'avatar' => 'https://via.placeholder.com/150',
                'name' => 'Laura Martín',
                'text' => 'La tienda tiene una gran variedad de productos y todo lo que he probado es delicioso. Además, el envío fue muy rápido y el empaque estaba en perfecto estado. ¡Recomiendo esta tienda 100%!',
                'rating' => 5,
            ],
        ]);
    }
}