@extends('layouts.app')

@section('title', 'Detalles de la Sede Universitaria')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles de la Sede Universitaria
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $campus->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Tipo de Sede:</label>
                    <p>
                        <span class="badge bg-info">{{ $campus->campus_type }}</span>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Departamento:</label>
                    <p class="form-control-plaintext">{{ $campus->department }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Municipio:</label>
                    <p class="form-control-plaintext">{{ $campus->municipality }}</p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Dirección:</label>
                    <p class="form-control-plaintext">{{ $campus->address }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($campus->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Programas Asociados:</label>
                    <p class="form-control-plaintext">{{ $campus->programs_count ?? 0 }} programas</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $campus->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $campus->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($campus->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $campus->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            {{-- Información de relaciones --}}
            @if($campus->programs && $campus->programs->count() > 0)
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="bi bi-book me-2"></i>Programas Asociados
                </h6>
                <div class="row">
                    @foreach($campus->programs as $program)
                    <div class="col-md-6 mb-2">
                        <div class="card border-0 bg-light">
                            <div class="card-body py-2">
                                <h6 class="card-title mb-1">{{ $program->name }}</h6>
                                <p class="card-text small text-muted mb-0">{{ $program->description ?? 'Sin descripción' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('campuses.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                @if(auth()->user()->role === 'admin')
                <div class="btn-group">
                    <a href="{{ route('campuses.edit', $campus) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Sede
                    </a>
                    <form action="{{ route('campuses.destroy', $campus) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de que desea eliminar esta sede?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-2">
                            <i class="bi bi-trash me-2"></i>Eliminar Sede
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
                if (!confirm('¿Está seguro de que desea eliminar esta sede? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection