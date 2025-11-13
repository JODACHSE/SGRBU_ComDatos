<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanResourcesSeeder extends Seeder
{
    public function run(): void
    {
        $loanResources = [];
        
        // Para cada préstamo, agregar 1-3 recursos
        for ($loanId = 1; $loanId <= 50; $loanId++) {
            $resourceCount = rand(1, 3);
            $selectedResources = collect(range(1, 20))->random($resourceCount);
            
            foreach ($selectedResources as $resourceId) {
                $loanResources[] = [
                    'loan_id' => $loanId,
                    'resource_id' => $resourceId,
                    'is_active' => 1,
                    'created_at' => now()->subDays(rand(1, 90)),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ];
            }
        }

        DB::table('loan_resources')->insert($loanResources);
        
        // Actualizar estado de recursos a "prestado" para préstamos activos
        DB::table('resources')
            ->whereIn('id', function($query) {
                $query->select('resource_id')
                    ->from('loan_resources')
                    ->whereIn('loan_id', function($q) {
                        $q->select('id')
                            ->from('loans')
                            ->whereIn('loan_status', ['activo', 'vencido']);
                    });
            })
            ->update(['resource_status_id' => 2]); // Prestado
    }
}