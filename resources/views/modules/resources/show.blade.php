@extends('layouts.app')

@section('title', 'Detalles del Recurso')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles del Recurso
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $resource->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Código del Recurso:</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-secondary">{{ $resource->resource_code }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Nombre:</label>
                    <p class="form-control-plaintext">{{ $resource->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Sede:</label>
                    <p class="form-control-plaintext">
                        {{ $resource->campus->municipality ?? 'N/A' }} -
                        <span class="badge bg-info">{{ $resource->campus->campus_type ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Tipo de Recurso:</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-info">{{ $resource->resourceType->name ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado del Recurso:</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-warning">{{ $resource->resourceStatus->name ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Descripción:</label>
                    <p class="form-control-plaintext">{{ $resource->description ?? 'Sin descripción' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($resource->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $resource->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $resource->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($resource->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $resource->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            {{-- Información de préstamos --}}
            @if($resource->loanResources && $resource->loanResources->count() > 0)
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="bi bi-clock-history me-2"></i>Historial de Préstamos
                </h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>ID Préstamo</th>
                                <th>Fecha Préstamo</th>
                                <th>Estado</th>
                                <th>Fecha Devolución</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resource->loanResources as $loanResource)
                            <tr>
                                <td>{{ $loanResource->loan_id }}</td>
                                <td>{{ $loanResource->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-info">Prestado</span>
                                </td>
                                <td>{{ $loanResource->updated_at->format('d/m/Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('resources.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al inventario
                </a>

                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                <div class="btn-group">
                    <a href="{{ route('resources.edit', $resource) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Recurso
                    </a>
                    <form action="{{ route('resources.destroy', $resource) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de que desea eliminar este recurso?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-2">
                            <i class="bi bi-trash me-2"></i>Eliminar Recurso
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
                if (!confirm('¿Está seguro de que desea eliminar este recurso? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection