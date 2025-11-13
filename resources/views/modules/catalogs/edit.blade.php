@extends('layouts.app')

@section('title', 'Editar Registro')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Editar Registro - {{ ucfirst(str_replace('-', ' ', $catalogName)) }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route($catalogName . '.update', $record) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $record->name) }}"
                            required
                            placeholder="Ingrese el nombre">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label fw-bold">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="Ingrese una descripción (opcional)">{{ old('description', $record->description) }}</textarea>
                        @error('description')
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
                                {{ $record->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                @if($record->is_active)
                                <span class="badge bg-success">Activo</span>
                                @else
                                <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('catalogs.index', ['catalog' => $catalogName]) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Registro
                        </button>
                        <a href="{{ route($catalogName . '.show', $record) }}" class="btn btn-info ms-2">
                            <i class="bi bi-eye me-2"></i>Ver Detalles
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection