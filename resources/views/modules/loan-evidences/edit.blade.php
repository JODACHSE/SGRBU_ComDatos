@extends('layouts.app')

@section('title', 'Editar Evidencia')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Editar Evidencia #{{ $loanEvidence->id }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('loan-evidences.update', $loanEvidence) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="loan_resource_id" class="form-label fw-bold">Recurso del Préstamo <span class="text-danger">*</span></label>
                        <select class="form-select @error('loan_resource_id') is-invalid @enderror" 
                                id="loan_resource_id" name="loan_resource_id" required>
                            <option value="">-- Seleccione un recurso de préstamo --</option>
                            @foreach($loanResources as $loanResource)
                            <option value="{{ $loanResource->id }}" {{ old('loan_resource_id', $loanEvidence->loan_resource_id) == $loanResource->id ? 'selected' : '' }}>
                                Préstamo #{{ $loanResource->loan_id }} - {{ $loanResource->resource->name }} ({{ $loanResource->loan->user->name }})
                            </option>
                            @endforeach
                        </select>
                        @error('loan_resource_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="loan_type" class="form-label fw-bold">Tipo de Evidencia <span class="text-danger">*</span></label>
                        <select class="form-select @error('loan_type') is-invalid @enderror" 
                                id="loan_type" name="loan_type" required>
                            <option value="prestamo" {{ old('loan_type', $loanEvidence->loan_type) == 'prestamo' ? 'selected' : '' }}>Préstamo</option>
                            <option value="devuelucion" {{ old('loan_type', $loanEvidence->loan_type) == 'devuelucion' ? 'selected' : '' }}>Devolución</option>
                        </select>
                        @error('loan_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="photo" class="form-label fw-bold">Foto de Evidencia</label>
                        <input type="file" 
                               class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" 
                               name="photo" 
                               accept="image/*">
                        @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 5MB. Deje en blanco para mantener la imagen actual.</div>
                        
                        @if($loanEvidence->photo_path)
                        <div class="mt-2">
                            <p class="mb-1">Imagen actual:</p>
                            <img src="{{ $loanEvidence->photo_url }}" 
                                 alt="Evidencia actual" 
                                 class="img-thumbnail" 
                                 style="max-height: 200px;">
                        </div>
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label fw-bold">Notas</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror"
                                id="notes" 
                                name="notes" 
                                rows="3" 
                                placeholder="Ingrese notas adicionales sobre la evidencia...">{{ old('notes', $loanEvidence->notes) }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                type="checkbox"
                                role="switch"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ $loanEvidence->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                @if($loanEvidence->is_active)
                                <span class="badge bg-success">Activo</span>
                                @else
                                <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('loan-evidences.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Evidencia
                        </button>
                        <a href="{{ route('loan-evidences.show', $loanEvidence) }}" class="btn btn-info ms-2">
                            <i class="bi bi-eye me-2"></i>Ver Detalles
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection