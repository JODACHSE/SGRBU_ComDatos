@extends('layouts.app')

@section('title', 'Crear Nueva Sede Universitaria')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>Crear Nueva Sede Universitaria
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('campuses.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="campus_type" class="form-label fw-bold">Tipo de Sede <span class="text-danger">*</span></label>
                        <select class="form-select @error('campus_type') is-invalid @enderror"
                            id="campus_type"
                            name="campus_type"
                            required>
                            <option value="">-- Seleccione el tipo --</option>
                            <option value="Principal" {{ old('campus_type') == 'Principal' ? 'selected' : '' }}>Principal</option>
                            <option value="Seccional" {{ old('campus_type') == 'Seccional' ? 'selected' : '' }}>Seccional</option>
                            <option value="Extensión" {{ old('campus_type') == 'Extensión' ? 'selected' : '' }}>Extensión</option>
                            <option value="Oficinas" {{ old('campus_type') == 'Oficinas' ? 'selected' : '' }}>Oficinas</option>
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
                            value="{{ old('department', 'Cundinamarca') }}"
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
                            value="{{ old('municipality') }}"
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
                            value="{{ old('address') }}"
                            required
                            placeholder="Ingrese la dirección completa">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('campuses.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Crear Sede
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection