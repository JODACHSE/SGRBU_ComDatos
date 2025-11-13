<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertsSeeder extends Seeder
{
    public function run(): void
    {
        $alerts = [];
        $alertStatuses = ['reportado', 'en_revision', 'resuelto'];
        
        // Crear 30 alertas en el sistema
        for ($i = 1; $i <= 30; $i++) {
            $userId = rand(1, 4); // Cualquier usuario puede reportar
            $loanId = rand(1, 50);
            
            // Distribución: 40% reportado, 30% en revisión, 30% resuelto
            $statusIndex = rand(1, 100);
            if ($statusIndex <= 40) {
                $status = 'reportado';
            } elseif ($statusIndex <= 70) {
                $status = 'en_revision';
            } else {
                $status = 'resuelto';
            }

            $alerts[] = [
                'user_id' => $userId,
                'loan_id' => $loanId,
                'alert_status' => $status,
                'description' => $this->generateAlertDescription(),
                'created_at' => now()->subDays(rand(1, 60)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ];
        }

        DB::table('alerts')->insert($alerts);
    }

    private function generateAlertDescription()
    {
        $descriptions = [
            'Retraso en la devolución del recurso prestado',
            'Recurso devuelto con daños menores',
            'Usuario no retiró el recurso reservado',
            'Error en el registro de devolución',
            'Recurso no encontrado en inventario',
            'Discrepancia en el estado del recurso',
            'Préstamo vencido sin comunicación del usuario',
            'Problema con el código de recurso escaneado',
            'Usuario reporta recurso en mal estado',
            'Conflicto de reservas para el mismo recurso',
            'Falta de documentación en préstamo especial',
            'Recurso prestado a usuario no autorizado',
            'Error en fechas de préstamo en el sistema',
            'Pérdida temporal de recurso prestado',
            'Daño grave reportado en recurso devuelto'
        ];

        return $descriptions[array_rand($descriptions)];
    }
}