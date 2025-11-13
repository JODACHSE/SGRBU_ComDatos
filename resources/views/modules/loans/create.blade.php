@extends('layouts.app')

@section('title', 'Crear Nuevo Préstamo')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-plus-circle me-2"></i>Crear Nuevo Préstamo
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('loans.store') }}" method="POST" id="loanForm">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label fw-bold">Usuario <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror"
                            id="user_id"
                            name="user_id"
                            required>
                            <option value="">-- Seleccione el usuario --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} {{ $user->lastname }} - {{ $user->role }}
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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

                    <div class="col-md-4 mb-3">
                        <label for="loan_date" class="form-label fw-bold">Fecha de Préstamo <span class="text-danger">*</span></label>
                        <input type="datetime-local"
                            class="form-control @error('loan_date') is-invalid @enderror"
                            id="loan_date"
                            name="loan_date"
                            value="{{ old('loan_date', now()->format('Y-m-d\TH:i')) }}"
                            required>
                        @error('loan_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="expected_return_date" class="form-label fw-bold">Fecha Esperada Devolución <span class="text-danger">*</span></label>
                        <input type="datetime-local"
                            class="form-control @error('expected_return_date') is-invalid @enderror"
                            id="expected_return_date"
                            name="expected_return_date"
                            value="{{ old('expected_return_date', now()->addDays(7)->format('Y-m-d\TH:i')) }}"
                            required>
                        @error('expected_return_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="loan_status" class="form-label fw-bold">Estado del Préstamo <span class="text-danger">*</span></label>
                        <select class="form-select @error('loan_status') is-invalid @enderror"
                            id="loan_status"
                            name="loan_status"
                            required>
                            <option value="">-- Seleccione el estado --</option>
                            <option value="pendiente" {{ old('loan_status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="aprovado" {{ old('loan_status') == 'aprovado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="activo" {{ old('loan_status') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="completado" {{ old('loan_status') == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="vencido" {{ old('loan_status') == 'vencido' ? 'selected' : '' }}>Vencido</option>
                            <option value="cancelado" {{ old('loan_status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                        @error('loan_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="resources" class="form-label fw-bold">Recursos <span class="text-danger">*</span></label>
                        <select class="form-select @error('resources') is-invalid @enderror"
                            id="resources"
                            name="resources[]"
                            multiple
                            required
                            size="5">
                            @foreach($resources as $resource)
                            <option value="{{ $resource->id }}" {{ in_array($resource->id, old('resources', [])) ? 'selected' : '' }}>
                                {{ $resource->resource_code }} - {{ $resource->name }} ({{ $resource->resourceType->name ?? 'N/A' }})
                            </option>
                            @endforeach
                        </select>
                        @error('resources')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Mantén presionada la tecla Ctrl (Cmd en Mac) para seleccionar múltiples recursos</small>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label fw-bold">Notas</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror"
                            id="notes"
                            name="notes"
                            rows="3"
                            placeholder="Ingrese notas adicionales sobre el préstamo (opcional)">{{ old('notes') }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Crear Préstamo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación de fechas
        const loanDate = document.getElementById('loan_date');
        const expectedReturnDate = document.getElementById('expected_return_date');
        
        function validateDates() {
            if (loanDate.value && expectedReturnDate.value) {
                const loanDateTime = new Date(loanDate.value);
                const expectedDateTime = new Date(expectedReturnDate.value);
                
                if (expectedDateTime <= loanDateTime) {
                    expectedReturnDate.setCustomValidity('La fecha de devolución debe ser posterior a la fecha de préstamo');
                } else {
                    expectedReturnDate.setCustomValidity('');
                }
            }
        }
        
        loanDate.addEventListener('change', validateDates);
        expectedReturnDate.addEventListener('change', validateDates);
        
        // Validación del formulario
        document.getElementById('loanForm').addEventListener('submit', function(e) {
            validateDates();
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
</script>
@endpush
@endsection