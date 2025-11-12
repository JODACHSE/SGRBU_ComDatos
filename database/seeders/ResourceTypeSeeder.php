<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('resource_types')->insert([
            [
                'name' => 'Deportivo',
                'description' => 'Equipos y materiales para actividades deportivas',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Instrumento Musical',
                'description' => 'Instrumentos para práctica musical',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Juego de Mesa',
                'description' => 'Juegos de entretenimiento y estrategia',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Audiovisual',
                'description' => 'Equipos de sonido y video',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Educativo',
                'description' => 'Materiales para apoyo educativo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
