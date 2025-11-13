@extends('layouts.app')

@section('title', 'Crear Nueva Alerta')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>Crear Nueva Alerta
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('alerts.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label fw-bold">Usuario <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror"
                            id="user_id" name="user_id" required>
                            <option value="">-- Seleccione un usuario --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->identification_number }})
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="loan_id" class="form-label fw-bold">Préstamo <span class="text-danger">*</span></label>
                        <select class="form-select @error('loan_id') is-invalid @enderror"
                            id="loan_id" name="loan_id" required>
                            <option value="">-- Seleccione un préstamo --</option>
                            @foreach($loans as $loan)
                            <option value="{{ $loan->id }}" {{ old('loan_id') == $loan->id ? 'selected' : '' }}>
                                Préstamo #{{ $loan->id }} - {{ $loan->user->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('loan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="alert_status" class="form-label fw-bold">Estado de Alerta <span class="text-danger">*</span></label>
                        <select class="form-select @error('alert_status') is-invalid @enderror"
                            id="alert_status" name="alert_status" required>
                            <option value="reportado" {{ old('alert_status') == 'reportado' ? 'selected' : '' }}>Reportado</option>
                            <option value="en_revision" {{ old('alert_status') == 'en_revision' ? 'selected' : '' }}>En Revisión</option>
                            <option value="resuelto" {{ old('alert_status') == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                        </select>
                        @error('alert_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label fw-bold">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description"
                            name="description"
                            rows="4"
                            required
                            placeholder="Describa la alerta o incidencia...">{{ old('description') }}</textarea>
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
                                checked>
                            <label class="form-check-label" for="is_active">
                                <span class="badge bg-success">Activo</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('alerts.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Crear Alerta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection