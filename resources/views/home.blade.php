@extends('layouts.app')

@section('title', 'Dashboard')

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

<div class="container-fluid">
    <!-- Header de Bienvenida -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="card-title mb-1">¡Hola {{ $user->name }} {{ $user->lastname }}!</h4>
                            <p class="card-text mb-0">Bienvenido al sistema de gestión de recursos</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="badge bg-light text-primary fs-6">{{ $userType }}</span>
                            <p class="mb-0 mt-2"><small>{{ now()->format('l, d F Y') }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard para Admin y Staff -->
    @if(in_array($user->role, ['admin', 'staff']))
    @include('modules.dashboards.admin-staff')
    @endif

    <!-- Dashboard para Estudiantes y Profesores -->
    @if(in_array($user->role, ['estudiante', 'profesor']))
    @include('modules.dashboards.student-teacher')
    @endif

</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Scripts para gráficos -->
@if(in_array($user->role, ['admin', 'staff']))
@include('modules.dashboards.charts-scripts')
@endif

@endsection