@extends('layouts.app')

@section('title', 'Crear Nueva Evidencia')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>Crear Nueva Evidencia
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('loan-evidences.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="loan_resource_id" class="form-label fw-bold">Recurso del Préstamo <span class="text-danger">*</span></label>
                        <select class="form-select @error('loan_resource_id') is-invalid @enderror" 
                                id="loan_resource_id" name="loan_resource_id" required>
                            <option value="">-- Seleccione un recurso de préstamo --</option>
                            @foreach($loanResources as $loanResource)
                            <option value="{{ $loanResource->id }}" {{ old('loan_resource_id') == $loanResource->id ? 'selected' : '' }}>
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
                            <option value="prestamo" {{ old('loan_type') == 'prestamo' ? 'selected' : '' }}>Préstamo</option>
                            <option value="devuelucion" {{ old('loan_type') == 'devuelucion' ? 'selected' : '' }}>Devolución</option>
                        </select>
                        @error('loan_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="photo" class="form-label fw-bold">Foto de Evidencia <span class="text-danger">*</span></label>
                        <input type="file" 
                               class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" 
                               name="photo" 
                               accept="image/*"
                               required>
                        @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Formatos permitidos: JPEG, PNG, JPG, GIF. Tamaño máximo: 5MB.</div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label fw-bold">Notas</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror"
                                id="notes" 
                                name="notes" 
                                rows="3" 
                                placeholder="Ingrese notas adicionales sobre la evidencia...">{{ old('notes') }}</textarea>
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
                                checked>
                            <label class="form-check-label" for="is_active">
                                <span class="badge bg-success">Activo</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('loan-evidences.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Crear Evidencia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection