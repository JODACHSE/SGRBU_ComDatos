@extends('layouts.app')

@section('title', 'Detalles del Registro')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles del Registro
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $record->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Nombre:</label>
                    <p class="form-control-plaintext">{{ $record->name }}</p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Descripción:</label>
                    <p class="form-control-plaintext">{{ $record->description ?? 'Sin descripción' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($record->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $record->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $record->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($record->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $record->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('catalogs.index', ['catalog' => $catalogName]) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                @if(auth()->user()->role === 'admin')
                <div class="btn-group">
                    <a href="{{ route($catalogName . '.edit', $record) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Registro
                    </a>
                    @php
                    $accion = $record->is_active ? 'inactivar' : 'activar';
                    $mensajeConfirmacion = "¿Está seguro de que desea {$accion} este registro?";
                    @endphp
                    <form action="{{ route('catalogs.toggle-active', [$catalogName, $record->id]) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('{{ $mensajeConfirmacion }}')">
                        @csrf
                        <button type="submit"
                            class="btn {{ $record->is_active ? 'btn-danger' : 'btn-success' }} ms-2">
                            <i class="bi {{ $record->is_active ? 'bi-x-circle' : 'bi-check-circle' }} me-2"></i>
                            {{ $record->is_active ? 'Inactivar' : 'Activar' }}
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Script alternativo para confirmaciones --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmación antes de inactivar/activar en la vista show
        const toggleForms = document.querySelectorAll('form[action*="toggle-active"]');
        toggleForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const isActive = this.querySelector('button').classList.contains('btn-danger');
                const action = isActive ? 'inactivar' : 'activar';
                if (!confirm(`¿Está seguro de que desea ${action} este registro?`)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection