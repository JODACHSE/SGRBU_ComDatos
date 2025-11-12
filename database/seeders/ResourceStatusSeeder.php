<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('resource_statuses')->insert([
            [
                'name' => 'Disponible',
                'description' => 'Recurso disponible para préstamo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Prestado',
                'description' => 'Recurso actualmente en préstamo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mantenimiento',
                'description' => 'Recurso en mantenimiento o reparación',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dañado',
                'description' => 'Recurso dañado fuera de servicio',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Reservado',
                'description' => 'Recurso reservado para próximo préstamo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
