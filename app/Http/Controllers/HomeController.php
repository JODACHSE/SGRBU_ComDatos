<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Resource;
use App\Models\Loan;
use App\Models\Campus;
use App\Models\Alert;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Definir el tipo de usuario para el mensaje
        $userType = match ($user->role) {
            'admin' => 'Administrador',
            'staff' => 'Staff',
            'profesor' => 'Profesor',
            'estudiante' => 'Estudiante',
            default => 'Usuario'
        };

        // Datos para gráficos y estadísticas
        $data = $this->getDashboardData($user);

        return view('home', compact('user', 'userType', 'data'));
    }

    private function getDashboardData($user)
    {
        $data = [];

        // Datos comunes para todos los roles
        $data['user_stats'] = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'total_resources' => Resource::count(),
            'available_resources' => Resource::where('resource_status_id', 1)->count(),
            'active_loans' => Loan::where('loan_status', 'activo')->count(),
            'pending_loans' => Loan::where('loan_status', 'pendiente')->count(),
        ];

        // Datos específicos por rol
        if (in_array($user->role, ['admin', 'staff'])) {
            // Datos para admin y staff
            $data['admin_stats'] = [
                'total_campuses' => Campus::count(),
                'total_alerts' => Alert::count(),
                'pending_alerts' => Alert::where('alert_status', 'reportado')->count(),
                'overdue_loans' => Loan::where('expected_return_date', '<', now())
                    ->where('loan_status', 'activo')
                    ->count(),
            ];

            // Datos para gráficos
            $data['charts'] = $this->getAdminCharts();
        } else {
            // Datos para estudiantes y profesores
            $data['user_loans'] = [
                'my_loans' => $user->loans()->count(),
                'my_active_loans' => $user->loans()->where('loan_status', 'activo')->count(),
                'my_pending_loans' => $user->loans()->where('loan_status', 'pendiente')->count(),
                'my_completed_loans' => $user->loans()->where('loan_status', 'completado')->count(),
            ];

            $data['recent_loans'] = $user->loans()
                ->with('campus')
                ->latest()
                ->take(5)
                ->get();

            $data['available_resources_by_type'] = Resource::where('is_active', true)
                ->where('resource_status_id', 1)
                ->with('resourceType')
                ->get()
                ->groupBy('resourceType.name')
                ->map->count();
        }

        return $data;
    }

    private function getAdminCharts()
    {
        // Datos para gráficos de préstamos por estado
        $loanStatusData = Loan::selectRaw('loan_status, count(*) as count')
            ->groupBy('loan_status')
            ->get()
            ->pluck('count', 'loan_status');

        // Datos para gráficos de recursos por tipo
        $resourceTypeData = Resource::with('resourceType')
            ->get()
            ->groupBy('resourceType.name')
            ->map->count();

        // Datos para gráficos de usuarios por rol
        $userRoleData = User::selectRaw('role, count(*) as count')
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role');

        // Datos para gráficos de préstamos por mes (últimos 6 meses)
        $monthlyLoans = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('M Y');
            $count = Loan::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $monthlyLoans[$monthName] = $count;
        }

        return [
            'loan_status' => $loanStatusData,
            'resource_types' => $resourceTypeData,
            'user_roles' => $userRoleData,
            'monthly_loans' => $monthlyLoans,
        ];
    }
}
