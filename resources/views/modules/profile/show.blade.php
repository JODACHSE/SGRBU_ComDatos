@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
            @if(isset($breadcrumb['url']))
            <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
            @else
            <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
            @endif
            @endforeach
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-4">
            <!-- Tarjeta de Información Personal -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-circle me-2"></i>Información Personal
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 2rem;"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p><strong>Nombre completo:</strong><br>
                                {{ $user->name }}
                                {{ $user->second_name ?? '' }}
                                {{ $user->lastname }}
                                {{ $user->second_lastname ?? '' }}
                            </p>

                            <p><strong>Tipo de documento:</strong><br>
                                {{ $user->documentType->name ?? 'No especificado' }}
                            </p>

                            <p><strong>Número de identificación:</strong><br>
                                {{ $user->identification_number }}
                            </p>

                            <p><strong>Género:</strong><br>
                                {{ $user->gender->name ?? 'No especificado' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Tarjeta de Información de Contacto y Académica -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-telephone-fill me-2"></i>Información de Contacto
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong><br>
                                {{ $user->email }}
                            </p>

                            <p><strong>Contacto de emergencia:</strong><br>
                                {{ $user->emergency_contact_name }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Teléfono de emergencia:</strong><br>
                                {{ $user->emergency_contact_phone }}
                            </p>

                            <p><strong>Rol:</strong><br>
                                <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Académica -->
            @if(in_array($user->role, ['estudiante', 'profesor']))
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-book-fill me-2"></i>Información Académica
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Programa:</strong><br>
                                {{ $user->campusProgram->program->name ?? 'No asignado' }}
                            </p>

                            <p><strong>Sede:</strong><br>
                                {{ $user->campusProgram->campus->name ?? 'No asignado' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Estado académico:</strong><br>
                                @php
                                $statusColors = [
                                'activo' => 'success',
                                'baja temporal' => 'warning',
                                'baja permanente' => 'danger',
                                'condicional' => 'warning',
                                'egresado' => 'info'
                                ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$user->academic_status] ?? 'secondary' }}">
                                    {{ ucfirst($user->academic_status) }}
                                </span>
                            </p>

                            @if($user->student_code)
                            <p><strong>Código de estudiante:</strong><br>
                                {{ $user->student_code }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection