<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('document_types')->insert([
            [
                'name' => 'Cédula de Ciudadanía',
                'description' => 'Documento nacional de identidad colombiano',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tarjeta de Identidad',
                'description' => 'Documento para menores de edad',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cédula de Extranjería',
                'description' => 'Documento para extranjeros en Colombia',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pasaporte',
                'description' => 'Documento para viajes internacionales',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Registro Civil',
                'description' => 'Documento de identificación para recién nacidos',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
