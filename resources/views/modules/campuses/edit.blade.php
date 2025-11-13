@extends('layouts.app')

@section('title', 'Editar Sede Universitaria')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Editar Sede Universitaria
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('campuses.update', $campus) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="campus_type" class="form-label fw-bold">Tipo de Sede <span class="text-danger">*</span></label>
                        <select class="form-select @error('campus_type') is-invalid @enderror"
                            id="campus_type"
                            name="campus_type"
                            required>
                            <option value="">-- Seleccione el tipo --</option>
                            <option value="Principal" {{ old('campus_type', $campus->campus_type) == 'Principal' ? 'selected' : '' }}>Principal</option>
                            <option value="Seccional" {{ old('campus_type', $campus->campus_type) == 'Seccional' ? 'selected' : '' }}>Seccional</option>
                            <option value="Extensión" {{ old('campus_type', $campus->campus_type) == 'Extensión' ? 'selected' : '' }}>Extensión</option>
                            <option value="Oficinas" {{ old('campus_type', $campus->campus_type) == 'Oficinas' ? 'selected' : '' }}>Oficinas</option>
                        </select>
                        @error('campus_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label fw-bold">Departamento <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('department') is-invalid @enderror"
                            id="department"
                            name="department"
                            value="{{ old('department', $campus->department) }}"
                            required
                            placeholder="Ingrese el departamento">
                        @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="municipality" class="form-label fw-bold">Municipio <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('municipality') is-invalid @enderror"
                            id="municipality"
                            name="municipality"
                            value="{{ old('municipality', $campus->municipality) }}"
                            required
                            placeholder="Ingrese el municipio">
                        @error('municipality')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label fw-bold">Dirección <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('address') is-invalid @enderror"
                            id="address"
                            name="address"
                            value="{{ old('address', $campus->address) }}"
                            required
                            placeholder="Ingrese la dirección completa">
                        @error('address')
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
                                {{ $campus->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                @if($campus->is_active)
                                <span class="badge bg-success">Activo</span>
                                @else
                                <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('campuses.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Sede
                        </button>
                        <a href="{{ route('campuses.show', $campus) }}" class="btn btn-info ms-2">
                            <i class="bi bi-eye me-2"></i>Ver Detalles
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection