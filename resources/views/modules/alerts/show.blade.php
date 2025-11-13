@extends('layouts.app')

@section('title', 'Detalles de la Alerta')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles de la Alerta #{{ $alert->id }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $alert->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Usuario:</label>
                    <p class="form-control-plaintext">
                        {{ $alert->user->name }}
                        <br>
                        <small class="text-muted">{{ $alert->user->identification_number }}</small>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Préstamo:</label>
                    <p class="form-control-plaintext">
                        Préstamo #{{ $alert->loan_id }}
                        <br>
                        <small class="text-muted">Usuario: {{ $alert->loan->user->name }}</small>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado de Alerta:</label>
                    <p>
                        @if($alert->alert_status == 'reportado')
                        <span class="badge bg-danger">Reportado</span>
                        @elseif($alert->alert_status == 'en_revision')
                        <span class="badge bg-warning">En Revisión</span>
                        @else
                        <span class="badge bg-success">Resuelto</span>
                        @endif
                    </p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Descripción:</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            {{ $alert->description }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($alert->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $alert->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $alert->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($alert->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $alert->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('alerts.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                <div class="btn-group">
                    <a href="{{ route('alerts.edit', $alert) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Alerta
                    </a>
                    <form action="{{ route('alerts.destroy', $alert) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de eliminar esta alerta?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-2">
                            <i class="bi bi-trash me-2"></i>Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection