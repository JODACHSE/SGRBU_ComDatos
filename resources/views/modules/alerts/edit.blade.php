@extends('layouts.app')

@section('title', 'Editar Alerta')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Editar Alerta #{{ $alert->id }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('alerts.update', $alert) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label fw-bold">Usuario <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror"
                            id="user_id" name="user_id" required>
                            <option value="">-- Seleccione un usuario --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $alert->user_id) == $user->id ? 'selected' : '' }}>
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
                            <option value="{{ $loan->id }}" {{ old('loan_id', $alert->loan_id) == $loan->id ? 'selected' : '' }}>
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
                            <option value="reportado" {{ old('alert_status', $alert->alert_status) == 'reportado' ? 'selected' : '' }}>Reportado</option>
                            <option value="en_revision" {{ old('alert_status', $alert->alert_status) == 'en_revision' ? 'selected' : '' }}>En Revisión</option>
                            <option value="resuelto" {{ old('alert_status', $alert->alert_status) == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
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
                            placeholder="Describa la alerta o incidencia...">{{ old('description', $alert->description) }}</textarea>
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
                                {{ $alert->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                @if($alert->is_active)
                                <span class="badge bg-success">Activo</span>
                                @else
                                <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('alerts.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Alerta
                        </button>
                        <a href="{{ route('alerts.show', $alert) }}" class="btn btn-info ms-2">
                            <i class="bi bi-eye me-2"></i>Ver Detalles
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection