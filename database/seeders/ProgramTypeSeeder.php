<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('program_types')->insert([
            [
                'name' => 'Pregrado',
                'description' => 'Programas de grado universitario',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Posgrado',
                'description' => 'Especializaciones, maestrías y doctorados',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tecnología',
                'description' => 'Programas tecnológicos',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Técnico',
                'description' => 'Programas técnicos laborales',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Diplomado',
                'description' => 'Programas de educación continua',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
