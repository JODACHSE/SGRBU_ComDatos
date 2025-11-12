<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genders')->insert([
            [
                'name' => 'Masculino',
                'description' => 'Género masculino',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Femenino',
                'description' => 'Género femenino',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'No binario',
                'description' => 'Persona no binaria',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Prefiero no decir',
                'description' => 'No especificado',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
