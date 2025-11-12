<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('campuses')->insert([
            [
                'campus_type' => 'Principal',
                'department' => 'Cundinamarca',
                'municipality' => 'Fusagasugá',
                'address' => 'Diagonal 18 No. 20-29',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Seccional',
                'department' => 'Cundinamarca',
                'municipality' => 'Girardot',
                'address' => 'Carrera 19 N.º 24 - 209',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Seccional',
                'department' => 'Cundinamarca',
                'municipality' => 'Ubaté',
                'address' => 'Calle 6 N.º 9 - 80',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Extensión',
                'department' => 'Cundinamarca',
                'municipality' => 'Chía',
                'address' => 'Autopista Chía - Cajicá / Sector "El Cuarenta"',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Extensión',
                'department' => 'Cundinamarca',
                'municipality' => 'Facatativá',
                'address' => 'Calle 14 con Avenida 15',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Extensión',
                'department' => 'Cundinamarca',
                'municipality' => 'Soacha',
                'address' => 'Diagonal 9 N.º 4B-85',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Extensión',
                'department' => 'Cundinamarca',
                'municipality' => 'Zipaquirá',
                'address' => 'Carrera 7 N.º 1-31',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_type' => 'Oficinas',
                'department' => 'Cundinamarca',
                'municipality' => 'Bogotá',
                'address' => 'Carrera 20 No. 39-32, Teusaquillo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
