<?php

namespace App\View\Components;

use App\Models\Campus;
use Illuminate\View\Component;

class CampusGeoChart extends Component
{
    public $campusStats;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 1. Obtener las estadísticas por Campus
        $campusStats = Campus::withCount([
            // Contador de Recursos por campus
            'resources',

            // Contador de Préstamos ACTIVOS por campus
            'loans as active_loans_count' => function ($query) {
                // Asumiendo que el estado es 'activo'
                $query->where('loan_status', 'activo');
            }
        ])
            // 2. Añadir el conteo de Usuarios por Campus mediante Subconsulta/JOIN
            ->withCount([
                'users as total_users_count' => function ($query) {
                    // Unir users a través de campus_program
                    $query->join('campus_program', 'users.campus_program_id', '=', 'campus_program.id')
                        ->whereColumn('campus_program.campus_id', 'campuses.id');
                }
            ])
            ->get(['id', 'municipality', 'department'])
            ->map(function ($campus) {
                // 3. Formato para GeoChart
                return [
                    // Usamos Municipio y Departamento como ubicación geográfica
                    'location' => $campus->municipality . ', ' . $campus->department . ', Colombia',
                    'campus_name' => $campus->municipality,
                    'users_count' => $campus->total_users_count,
                    'resources_count' => $campus->resources_count,
                    'active_loans_count' => $campus->active_loans_count,
                ];
            });

        $this->campusStats = $campusStats->toJson();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.campus-geo-chart');
    }
}
