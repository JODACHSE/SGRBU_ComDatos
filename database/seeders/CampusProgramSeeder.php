<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusProgramSeeder extends Seeder
{
    public function run(): void
    {
        $campusPrograms = [];

        // Asociar programas a campus
        for ($programId = 1; $programId <= 9; $programId++) {
            // Cada programa está disponible en 2-3 campus diferentes
            $campusCount = rand(2, 3);
            $selectedCampuses = collect(range(1, 8))->random($campusCount);

            foreach ($selectedCampuses as $campusId) {
                $campusPrograms[] = [
                    'campus_id' => $campusId,
                    'program_id' => $programId,
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('campus_program')->insert($campusPrograms);
    }
}
