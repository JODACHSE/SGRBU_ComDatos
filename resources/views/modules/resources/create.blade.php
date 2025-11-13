@extends('layouts.app')

@section('title', 'Crear Nuevo Recurso')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Recurso
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('resources.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="campus_id" class="form-label fw-bold">Sede <span class="text-danger">*</span></label>
                        <select class="form-select @error('campus_id') is-invalid @enderror"
                            id="campus_id"
                            name="campus_id"
                            required>
                            <option value="">-- Seleccione la sede --</option>
                            @foreach($campuses as $campus)
                            <option value="{{ $campus->id }}" {{ old('campus_id') == $campus->id ? 'selected' : '' }}>
                                {{ $campus->municipality }} - {{ $campus->campus_type }}
                            </option>
                            @endforeach
                        </select>
                        @error('campus_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="resource_type_id" class="form-label fw-bold">Tipo de Recurso <span class="text-danger">*</span></label>
                        <select class="form-select @error('resource_type_id') is-invalid @enderror"
                            id="resource_type_id"
                            name="resource_type_id"
                            required>
                            <option value="">-- Seleccione el tipo --</option>
                            @foreach($resourceTypes as $type)
                            <option value="{{ $type->id }}" {{ old('resource_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('resource_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="resource_status_id" class="form-label fw-bold">Estado del Recurso <span class="text-danger">*</span></label>
                        <select class="form-select @error('resource_status_id') is-invalid @enderror"
                            id="resource_status_id"
                            name="resource_status_id"
                            required>
                            <option value="">-- Seleccione el estado --</option>
                            @foreach($resourceStatuses as $status)
                            <option value="{{ $status->id }}" {{ old('resource_status_id') == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('resource_status_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="resource_code" class="form-label fw-bold">Código del Recurso <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('resource_code') is-invalid @enderror"
                            id="resource_code"
                            name="resource_code"
                            value="{{ old('resource_code') }}"
                            required
                            placeholder="Ej: REC-001">
                        @error('resource_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="name" class="form-label fw-bold">Nombre del Recurso <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Ingrese el nombre del recurso">
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
                            placeholder="Ingrese una descripción detallada del recurso (opcional)">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('resources.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Crear Recurso
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection