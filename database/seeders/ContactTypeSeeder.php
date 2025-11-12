<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contact_types')->insert([
            [
                'name' => 'Teléfono móvil',
                'description' => 'Número de celular personal',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Teléfono fijo',
                'description' => 'Número de teléfono fijo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Correo personal',
                'description' => 'Correo electrónico personal',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Correo institucional',
                'description' => 'Correo electrónico universitario',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'WhatsApp',
                'description' => 'Número de WhatsApp',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Facebook',
                'description' => 'Perfil de Facebook',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
