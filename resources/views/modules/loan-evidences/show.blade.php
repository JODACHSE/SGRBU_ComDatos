@extends('layouts.app')

@section('title', 'Detalles de la Evidencia')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles de la Evidencia #{{ $loanEvidence->id }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $loanEvidence->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Préstamo:</label>
                    <p class="form-control-plaintext">
                        Préstamo #{{ $loanEvidence->loanResource->loan_id }}
                        <br>
                        <small class="text-muted">Usuario: {{ $loanEvidence->loanResource->loan->user->name }}</small>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Recurso:</label>
                    <p class="form-control-plaintext">{{ $loanEvidence->loanResource->resource->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Tipo de Evidencia:</label>
                    <p>
                        @if($loanEvidence->loan_type == 'prestamo')
                            <span class="badge bg-info">Préstamo</span>
                        @else
                            <span class="badge bg-warning">Devolución</span>
                        @endif
                    </p>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Foto de Evidencia:</label>
                    <div>
                        @if($loanEvidence->photo_path)
                            <img src="{{ $loanEvidence->photo_url }}" 
                                 alt="Evidencia de {{ $loanEvidence->loan_type_formatted }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 400px;">
                            <div class="mt-2">
                                <a href="{{ $loanEvidence->photo_url }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>Abrir en nueva pestaña
                                </a>
                            </div>
                        @else
                            <p class="text-muted">No hay imagen disponible</p>
                        @endif
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold text-primary">Notas:</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            {{ $loanEvidence->notes ?? 'Sin notas' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($loanEvidence->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $loanEvidence->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $loanEvidence->updated_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($loanEvidence->deleted_at)
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-danger">Fecha de Eliminación:</label>
                    <p class="form-control-plaintext">{{ $loanEvidence->deleted_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('loan-evidences.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                <div class="btn-group">
                    <a href="{{ route('loan-evidences.edit', $loanEvidence) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Evidencia
                    </a>
                    <form action="{{ route('loan-evidences.destroy', $loanEvidence) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Está seguro de eliminar esta evidencia?')">
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