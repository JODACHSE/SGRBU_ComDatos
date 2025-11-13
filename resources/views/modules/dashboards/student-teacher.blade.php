<!-- Estadísticas Personales -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Mis Préstamos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user_loans']['my_loans'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-arrow-left-right fa-2x text-gray-300"></i>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user_loans']['my_active_loans'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-clock-history fa-2x text-gray-300"></i>
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
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Préstamos Completados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['user_loans']['my_completed_loans'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Mis Préstamos Recientes -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mis Préstamos Recientes</h6>
            </div>
            <div class="card-body">
                @if($data['recent_loans']->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Recurso</th>
                                <th>Fecha Préstamo</th>
                                <th>Fecha Devolución</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['recent_loans'] as $loan)
                            <tr>
                                <td>
                                    @foreach($loan->loanResources as $resource)
                                    <span class="badge bg-secondary">{{ $resource->resource->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                                <td>{{ $loan->expected_return_date->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $loan->loan_status == 'activo' ? 'success' : ($loan->loan_status == 'pendiente' ? 'warning' : 'secondary') }}">
                                        {{ $loan->loan_status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No tienes préstamos recientes.</p>
                @endif
                <a href="{{ route('loans.index') }}" class="btn btn-outline-primary btn-sm mt-2">Ver Todos Mis Préstamos</a>
            </div>
        </div>
    </div>

    <!-- Recursos Disponibles por Tipo -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Recursos Disponibles</h6>
            </div>
            <div class="card-body">
                @if($data['available_resources_by_type']->count() > 0)
                    @foreach($data['available_resources_by_type'] as $type => $count)
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                        <span class="fw-medium">{{ $type }}</span>
                        <span class="badge bg-success">{{ $count }}</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted">No hay recursos disponibles.</p>
                @endif
                <a href="{{ route('resources.index') }}" class="btn btn-outline-success btn-sm mt-2 w-100">Explorar Recursos</a>
            </div>
        </div>
    </div>
</div>

<!-- Acciones Rápidas y Notificaciones -->
<div class="row">
    <!-- Acciones Rápidas -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-12 mb-3">
                        <a href="{{ route('loans.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle me-2"></i>Solicitar Nuevo Préstamo
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('loans.index') }}" class="btn btn-outline-warning w-100">
                            <i class="bi bi-list-ul me-1"></i>Mis Préstamos
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('resources.index') }}" class="btn btn-outline-success w-100">
                            <i class="bi bi-laptop me-1"></i>Ver Recursos
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-info w-100">
                            <i class="bi bi-person me-1"></i>Mi Perfil
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('alerts.create') }}" class="btn btn-outline-danger w-100">
                            <i class="bi bi-exclamation-triangle me-1"></i>Reportar Problema
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Usuario -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Mi Información</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Nombre:</strong>
                    <p class="mb-1">{{ $user->name }} {{ $user->lastname }}</p>
                </div>
                <div class="mb-3">
                    <strong>Email:</strong>
                    <p class="mb-1">{{ $user->email }}</p>
                </div>
                <div class="mb-3">
                    <strong>Código Estudiantil:</strong>
                    <p class="mb-1">{{ $user->student_code ?? 'No asignado' }}</p>
                </div>
                <div class="mb-3">
                    <strong>Estado Académico:</strong>
                    <span class="badge bg-{{ $user->academic_status == 'activo' ? 'success' : 'warning' }}">
                        {{ $user->academic_status }}
                    </span>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-info btn-sm w-100">Editar Perfil</a>
            </div>
        </div>
    </div>
</div>