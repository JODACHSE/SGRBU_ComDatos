<!-- Estadísticas Principales -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Usuarios</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user_stats']['total_users'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Recursos Disponibles</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user_stats']['available_resources'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-laptop fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Préstamos Activos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user_stats']['active_loans'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-arrow-left-right fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Alertas Pendientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['admin_stats']['pending_alerts'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="row mb-4">
    <!-- Gráfico de Préstamos por Estado -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Préstamos por Estado</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="loanStatusChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Recursos por Tipo -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Recursos por Tipo</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="resourceTypeChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Más Gráficos -->
<div class="row mb-4">
    <!-- Gráfico de Usuarios por Rol -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Usuarios por Rol</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar pt-4 pb-2">
                    <canvas id="userRoleChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Préstamos Mensuales -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">Préstamos Mensuales</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar pt-4 pb-2">
                    <canvas id="monthlyLoansChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alertas y Acciones Rápidas -->
<div class="row">
    <!-- Alertas Recientes -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Alertas Recientes</h6>
            </div>
            <div class="card-body">
                @php
                    $recentAlerts = \App\Models\Alert::with(['user', 'loan'])
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp
                @if($recentAlerts->count() > 0)
                    @foreach($recentAlerts as $alert)
                    <div class="alert alert-{{ $alert->alert_status == 'reportado' ? 'warning' : ($alert->alert_status == 'en_revision' ? 'info' : 'success') }} mb-2">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $alert->user->name }}</strong>
                            <span class="badge bg-{{ $alert->alert_status == 'reportado' ? 'warning' : ($alert->alert_status == 'en_revision' ? 'info' : 'success') }}">
                                {{ $alert->alert_status }}
                            </span>
                        </div>
                        <p class="mb-0 small">{{ Str::limit($alert->description, 100) }}</p>
                        <small class="text-muted">{{ $alert->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay alertas recientes.</p>
                @endif
                <a href="{{ route('alerts.index') }}" class="btn btn-outline-danger btn-sm mt-2">Ver Todas las Alertas</a>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bi bi-person-plus me-1"></i>Nuevo Usuario
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('resources.create') }}" class="btn btn-outline-success w-100 mb-2">
                            <i class="bi bi-plus-circle me-1"></i>Nuevo Recurso
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('loans.create') }}" class="btn btn-outline-warning w-100 mb-2">
                            <i class="bi bi-arrow-left-right me-1"></i>Nuevo Préstamo
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('alerts.create') }}" class="btn btn-outline-danger w-100 mb-2">
                            <i class="bi bi-exclamation-triangle me-1"></i>Nueva Alerta
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('campuses.index') }}" class="btn btn-outline-info w-100 mb-2">
                            <i class="bi bi-building me-1"></i>Gestionar Campus
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('catalogs.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                            <i class="bi bi-list-ul me-1"></i>Catálogos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>