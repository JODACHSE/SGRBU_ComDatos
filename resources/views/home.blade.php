@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- Alerts --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
    <i class="bi bi-exclamation-circle-fill me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <strong>Por favor corrige los siguientes errores:</strong>
    <ul class="mb-0 mt-1">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="text-center mb-4">
                    <h4>Hola {{ $user->name }} {{ $user->lastname }}</h4>
                    <p class="text-muted">Bienvenido al home view de {{ $userType }}</p>
                    <span class="badge bg-primary">{{ $userType }}</span>
                </div>

                <!-- Estadísticas rápidas basadas en el rol -->
                <div class="row">
                    @if(in_array($user->role, ['admin', 'staff']))
                    <div class="col-md-4 mb-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ App\Models\User::count() }}</h5>
                                <p class="card-text">Usuarios</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card text-white bg-success">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ App\Models\Resource::count() }}</h5>
                                <p class="card-text">Recursos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ App\Models\Loan::where('loan_status', 'activo')->count() }}</h5>
                                <p class="card-text">Préstamos Activos</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-6 mb-3">
                        <div class="card text-white bg-info">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $user->loans()->count() }}</h5>
                                <p class="card-text">Mis Préstamos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-white bg-success">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ App\Models\Resource::where('is_active', true)->where('resource_status_id', 1)->count() }}</h5>
                                <p class="card-text">Recursos Disponibles</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Acciones rápidas -->
                <div class="mt-4">
                    <h5>Acciones Rápidas</h5>
                    <div class="d-grid gap-2 d-md-flex">
                        @if(in_array($user->role, ['admin', 'staff']))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary me-md-2">Gestionar Usuarios</a>
                        <a href="{{ route('resources.index') }}" class="btn btn-outline-success me-md-2">Gestionar Recursos</a>
                        <a href="{{ route('loans.index') }}" class="btn btn-outline-warning">Ver Préstamos</a>
                        @else
                        <a href="{{ route('loans.create') }}" class="btn btn-outline-primary me-md-2">Solicitar Préstamo</a>
                        <a href="{{ route('loans.index') }}" class="btn btn-outline-info">Mis Préstamos</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection