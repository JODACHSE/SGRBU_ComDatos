<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansSeeder extends Seeder
{
    public function run(): void
    {
        $loans = [];
        $loanStatuses = ['pendiente', 'aprovado', 'activo', 'completado', 'vencido', 'cancelado'];
        
        // Crear 50 préstamos históricos y activos
        for ($i = 1; $i <= 50; $i++) {
            $userId = rand(3, 4); // Solo estudiantes y profesores
            $campusId = rand(1, 8);
            $loanDate = now()->subDays(rand(1, 90));
            $expectedReturn = $loanDate->copy()->addDays(rand(1, 14));
            
            // 70% completados, 10% vencidos, 10% activos, 10% pendientes
            $statusIndex = rand(1, 100);
            if ($statusIndex <= 70) {
                $status = 'completado';
                $actualReturn = $expectedReturn->copy()->subDays(rand(0, 2));
            } elseif ($statusIndex <= 80) {
                $status = 'vencido';
                $actualReturn = null;
            } elseif ($statusIndex <= 90) {
                $status = 'activo';
                $actualReturn = null;
            } else {
                $status = 'pendiente';
                $actualReturn = null;
            }

            $loans[] = [
                'user_id' => $userId,
                'campus_id' => $campusId,
                'loan_date' => $loanDate,
                'expected_return_date' => $expectedReturn,
                'actual_return_date' => $actualReturn,
                'loan_status' => $status,
                'notes' => $this->generateLoanNotes($status),
                'is_active' => 1,
                'created_at' => $loanDate,
                'updated_at' => $actualReturn ?? now(),
            ];
        }

        DB::table('loans')->insert($loans);
    }

    private function generateLoanNotes($status)
    {
        $notes = [
            'pendiente' => ['Préstamo solicitado para actividades académicas', 'Material necesario para proyecto'],
            'aprovado' => ['Préstamo aprobado por coordinación', 'Documentación en orden'],
            'activo' => ['Recurso en uso actualmente', 'Usuario responsable'],
            'completado' => ['Devolución a tiempo y en buen estado', 'Recurso revisado y almacenado'],
            'vencido' => ['Préstamo vencido, notificar al usuario', 'Recurso pendiente por devolver'],
            'cancelado' => ['Usuario canceló la solicitud', 'Recurso no fue retirado']
        ];

        return $notes[$status][array_rand($notes[$status])];
    }
}