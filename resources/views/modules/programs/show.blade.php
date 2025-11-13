@extends('layouts.app')

@section('title', 'Detalles del Programa Académico')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles del Programa Académico
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $program->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Nombre:</label>
                    <p class="form-control-plaintext">{{ $program->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Tipo de Programa:</label>
                    <p>
                        <span class="badge bg-info">{{ $program->programType->name ?? 'N/A' }}</span>
                    </p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Descripción:</label>
                    <p class="form-control-plaintext">{{ $program->description ?? 'Sin descripción' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($program->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $program->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $program->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($program->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $program->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            {{-- Información de relaciones --}}
            @if($program->campuses && $program->campuses->count() > 0)
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="bi bi-building me-2"></i>Sedas Asociadas
                </h6>
                <div class="row">
                    @foreach($program->campuses as $campus)
                    <div class="col-md-6 mb-2">
                        <div class="card border-0 bg-light">
                            <div class="card-body py-2">
                                <h6 class="card-title mb-1">{{ $campus->municipality }}, {{ $campus->department }}</h6>
                                <p class="card-text small text-muted mb-0">{{ $campus->address }}</p>
                                <span class="badge bg-secondary">{{ $campus->campus_type }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('programs.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                @if(auth()->user()->role === 'admin')
                <div class="btn-group">
                    <a href="{{ route('programs.edit', $program) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Programa
                    </a>
                    <form action="{{ route('programs.destroy', $program) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de que desea eliminar este programa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-2">
                            <i class="bi bi-trash me-2"></i>Eliminar Programa
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
                if (!confirm('¿Está seguro de que desea eliminar este programa? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection