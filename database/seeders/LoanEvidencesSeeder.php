<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanEvidencesSeeder extends Seeder
{
    public function run(): void
    {
        $evidences = [];
        
        // Crear evidencias para el 80% de los recursos en préstamo
        $loanResources = DB::table('loan_resources')->get();
        
        foreach ($loanResources as $loanResource) {
            // 80% de probabilidad de tener evidencia
            if (rand(1, 100) <= 80) {
                $loanType = rand(1, 100) <= 70 ? 'prestamo' : 'devuelución';
                
                $evidences[] = [
                    'loan_resource_id' => $loanResource->id,
                    'loan_type' => $loanType,
                    'photo_path' => $this->generatePhotoPath(),
                    'notes' => $this->generateEvidenceNotes($loanType),
                    'is_active' => 1,
                    'created_at' => $loanResource->created_at,
                    'updated_at' => $loanResource->updated_at,
                ];
            }
        }

        DB::table('loan_evidences')->insert($evidences);
    }

    private function generatePhotoPath()
    {
        $paths = [
            'evidences/prestamos/foto_1.jpg',
            'evidences/prestamos/foto_2.jpg',
            'evidences/devoluciones/foto_1.jpg',
            'evidences/devoluciones/foto_2.jpg',
            'evidences/general/evidencia_1.jpg',
            'evidences/general/evidencia_2.jpg',
        ];
        
        return $paths[array_rand($paths)];
    }

    private function generateEvidenceNotes($loanType)
    {
        $notes = [
            'prestamo' => [
                'Foto tomada al momento del préstamo',
                'Estado del recurso verificado',
                'Usuario identificado correctamente',
                'Recurso en buen estado al prestar'
            ],
            'devuelución' => [
                'Recurso devuelto en buen estado',
                'Foto de confirmación de devolución',
                'Revisión de estado completada',
                'Devolución registrada correctamente'
            ]
        ];

        return $notes[$loanType][array_rand($notes[$loanType])];
    }
}