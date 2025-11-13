@extends('layouts.app')

@section('title', 'Crear Nuevo Programa Académico')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Programa Académico
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('programs.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="program_type_id" class="form-label fw-bold">Tipo de Programa <span class="text-danger">*</span></label>
                        <select class="form-select @error('program_type_id') is-invalid @enderror"
                            id="program_type_id"
                            name="program_type_id"
                            required>
                            <option value="">-- Seleccione el tipo --</option>
                            @foreach($programTypes as $programType)
                            <option value="{{ $programType->id }}" {{ old('program_type_id') == $programType->id ? 'selected' : '' }}>
                                {{ $programType->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('program_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-bold">Nombre del Programa <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Ingrese el nombre del programa">
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
                            placeholder="Ingrese una descripción del programa (opcional)">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('programs.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Crear Programa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection