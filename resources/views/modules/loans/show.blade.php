@extends('layouts.app')

@section('title', 'Detalles del Préstamo')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles del Préstamo
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $loan->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Usuario:</label>
                    <p class="form-control-plaintext">
                        {{ $loan->user->name ?? 'N/A' }} {{ $loan->user->lastname ?? '' }}
                        <span class="badge bg-secondary">{{ $loan->user->role ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Sede:</label>
                    <p class="form-control-plaintext">
                        {{ $loan->campus->municipality ?? 'N/A' }} -
                        <span class="badge bg-info">{{ $loan->campus->campus_type ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Préstamo:</label>
                    <p class="form-control-plaintext">{{ $loan->loan_date->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha Esperada Devolución:</label>
                    <p class="form-control-plaintext">{{ $loan->expected_return_date->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha Real Devolución:</label>
                    <p class="form-control-plaintext">
                        @if($loan->actual_return_date)
                        <span class="badge bg-success">{{ $loan->actual_return_date->format('d/m/Y H:i') }}</span>
                        @else
                        <span class="badge bg-warning">Pendiente</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @switch($loan->loan_status)
                        @case('pendiente')
                        <span class="badge bg-secondary">Pendiente</span>
                        @break
                        @case('aprovado')
                        <span class="badge bg-info">Aprobado</span>
                        @break
                        @case('activo')
                        <span class="badge bg-primary">Activo</span>
                        @break
                        @case('completado')
                        <span class="badge bg-success">Completado</span>
                        @break
                        @case('vencido')
                        <span class="badge bg-danger">Vencido</span>
                        @break
                        @case('cancelado')
                        <span class="badge bg-dark">Cancelado</span>
                        @break
                        @endswitch
                    </p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Notas:</label>
                    <p class="form-control-plaintext">{{ $loan->notes ?? 'Sin notas' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $loan->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $loan->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($loan->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $loan->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            {{-- Información de recursos --}}
            @if($loan->loanResources && $loan->loanResources->count() > 0)
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="bi bi-box-seam me-2"></i>Recursos Prestados
                </h6>
                <div class="row">
                    @foreach($loan->loanResources as $loanResource)
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="card-title">
                                    {{ $loanResource->resource->resource_code }} - {{ $loanResource->resource->name }}
                                </h6>
                                <p class="card-text small text-muted mb-1">
                                    {{ $loanResource->resource->description ?? 'Sin descripción' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-info">{{ $loanResource->resource->resourceType->name ?? 'N/A' }}</span>
                                    <span class="badge {{ $loanResource->resource->resource_status_id == 1 ? 'bg-success' : 'bg-warning' }}">
                                        {{ $loanResource->resource->resourceStatus->name ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                <div class="btn-group">
                    <a href="{{ route('loans.edit', $loan) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Préstamo
                    </a>

                    {{-- Botón para marcar como devuelto --}}
                    @if($loan->loan_status !== 'completado' && !$loan->actual_return_date)
                    <form action="{{ route('loans.markAsReturned', $loan) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de que desea marcar este préstamo como devuelto?')">
                        @csrf
                        <button type="submit" class="btn btn-success ms-2">
                            <i class="bi bi-check-circle me-2"></i>Marcar como Devuelto
                        </button>
                    </form>
                    @endif

                    <form action="{{ route('loans.destroy', $loan) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de que desea eliminar este préstamo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-2">
                            <i class="bi bi-trash me-2"></i>Eliminar Préstamo
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Script para confirmaciones --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmación antes de eliminar
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('¿Está seguro de que desea eliminar este préstamo? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });

        // Confirmación antes de marcar como devuelto
        const returnForms = document.querySelectorAll('form[action*="markAsReturned"]');
        returnForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('¿Está seguro de que desea marcar este préstamo como devuelto? Esta acción cambiará el estado de los recursos a "Disponible".')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection