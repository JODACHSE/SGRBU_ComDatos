@extends('layouts.app')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles del Usuario
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $user->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Nombre Completo:</label>
                    <p class="form-control-plaintext">
                        {{ $user->name }}
                        {{ $user->second_name ? $user->second_name . ' ' : '' }}
                        {{ $user->lastname }}
                        {{ $user->second_lastname ? $user->second_lastname : '' }}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Email:</label>
                    <p class="form-control-plaintext">{{ $user->email }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Rol:</label>
                    <p>
                        <span class="badge 
                            @if($user->role === 'admin') bg-danger
                            @elseif($user->role === 'staff') bg-warning text-dark
                            @elseif($user->role === 'profesor') bg-info
                            @else bg-success @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Tipo de Documento:</label>
                    <p class="form-control-plaintext">{{ $user->documentType->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Número de Identificación:</label>
                    <p class="form-control-plaintext">{{ $user->identification_number }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Género:</label>
                    <p class="form-control-plaintext">{{ $user->gender->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Programa:</label>
                    <p class="form-control-plaintext">
                        @if($user->campusProgram)
                        {{ $user->campusProgram->campus->name }} - {{ $user->campusProgram->program->name }}
                        @else
                        <span class="text-muted">N/A</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado Académico:</label>
                    <p class="form-control-plaintext">
                        <span class="badge 
                            @if($user->academic_status === 'activo') bg-success
                            @elseif($user->academic_status === 'baja temporal') bg-warning text-dark
                            @elseif($user->academic_status === 'baja permanente') bg-danger
                            @elseif($user->academic_status === 'condicional') bg-info
                            @else bg-secondary @endif">
                            {{ ucfirst($user->academic_status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Código Estudiantil:</label>
                    <p class="form-control-plaintext">{{ $user->student_code ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Contacto de Emergencia:</label>
                    <p class="form-control-plaintext">{{ $user->emergency_contact_name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Teléfono de Emergencia:</label>
                    <p class="form-control-plaintext">{{ $user->emergency_contact_phone }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($user->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                <div class="btn-group">
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Usuario
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection