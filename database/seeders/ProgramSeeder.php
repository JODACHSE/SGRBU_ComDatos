<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            // Pregrados
            [
                'program_type_id' => 1,
                'name' => 'Ingeniería de Sistemas',
                'description' => 'Ingeniería en desarrollo de software y TI',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'program_type_id' => 1,
                'name' => 'Administración de Empresas',
                'description' => 'Gestión y dirección empresarial',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'program_type_id' => 1,
                'name' => 'Contaduría Pública',
                'description' => 'Contabilidad y auditoría financiera',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'program_type_id' => 1,
                'name' => 'Derecho',
                'description' => 'Ciencias jurídicas y legales',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'program_type_id' => 1,
                'name' => 'Psicología',
                'description' => 'Ciencias del comportamiento humano',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Tecnologías
            [
                'program_type_id' => 3,
                'name' => 'Tecnología en Desarrollo de Software',
                'description' => 'Desarrollo de aplicaciones y sistemas',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'program_type_id' => 3,
                'name' => 'Tecnología en Gestión Empresarial',
                'description' => 'Gestión de pequeñas y medianas empresas',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Posgrados
            [
                'program_type_id' => 2,
                'name' => 'Maestría en Educación',
                'description' => 'Maestría en ciencias de la educación',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'program_type_id' => 2,
                'name' => 'Especialización en Gerencia de Proyectos',
                'description' => 'Especialización en dirección de proyectos',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('programs')->insert($programs);
    }
}
