@extends('layouts.app')

@section('title', 'Editar Préstamo')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Editar Préstamo
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('loans.update', $loan) }}" method="POST" id="loanForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label fw-bold">Usuario <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror"
                            id="user_id"
                            name="user_id"
                            required>
                            <option value="">-- Seleccione el usuario --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $loan->user_id) == $user->id ? 'selected' : '' }}>
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
                            <option value="{{ $campus->id }}" {{ old('campus_id', $loan->campus_id) == $campus->id ? 'selected' : '' }}>
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
                            value="{{ old('loan_date', $loan->loan_date->format('Y-m-d\TH:i')) }}"
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
                            value="{{ old('expected_return_date', $loan->expected_return_date->format('Y-m-d\TH:i')) }}"
                            required>
                        @error('expected_return_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="actual_return_date" class="form-label fw-bold">Fecha Real Devolución</label>
                        <input type="datetime-local"
                            class="form-control @error('actual_return_date') is-invalid @enderror"
                            id="actual_return_date"
                            name="actual_return_date"
                            value="{{ old('actual_return_date', $loan->actual_return_date ? $loan->actual_return_date->format('Y-m-d\TH:i') : '') }}">
                        @error('actual_return_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="loan_status" class="form-label fw-bold">Estado del Préstamo <span class="text-danger">*</span></label>
                        <select class="form-select @error('loan_status') is-invalid @enderror"
                            id="loan_status"
                            name="loan_status"
                            required>
                            <option value="">-- Seleccione el estado --</option>
                            <option value="pendiente" {{ old('loan_status', $loan->loan_status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="aprovado" {{ old('loan_status', $loan->loan_status) == 'aprovado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="activo" {{ old('loan_status', $loan->loan_status) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="completado" {{ old('loan_status', $loan->loan_status) == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="vencido" {{ old('loan_status', $loan->loan_status) == 'vencido' ? 'selected' : '' }}>Vencido</option>
                            <option value="cancelado" {{ old('loan_status', $loan->loan_status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                        @error('loan_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label fw-bold">Notas</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror"
                            id="notes"
                            name="notes"
                            rows="3"
                            placeholder="Ingrese notas adicionales sobre el préstamo (opcional)">{{ old('notes', $loan->notes) }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Información de recursos asociados (solo lectura) --}}
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Recursos Asociados</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                @if($loan->loanResources->count() > 0)
                                @foreach($loan->loanResources as $loanResource)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong>{{ $loanResource->resource->resource_code }}</strong> - {{ $loanResource->resource->name }}
                                        <span class="badge bg-info ms-2">{{ $loanResource->resource->resourceType->name ?? 'N/A' }}</span>
                                    </div>
                                    <span class="badge {{ $loanResource->resource->resource_status_id == 1 ? 'bg-success' : 'bg-warning' }}">
                                        {{ $loanResource->resource->resourceStatus->name ?? 'N/A' }}
                                    </span>
                                </div>
                                @endforeach
                                @else
                                <p class="text-muted mb-0">No hay recursos asociados a este préstamo.</p>
                                @endif
                            </div>
                        </div>
                        <small class="text-muted">Los recursos no se pueden modificar una vez creado el préstamo. Para cambiar los recursos, debe crear un nuevo préstamo.</small>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Préstamo
                        </button>
                        <a href="{{ route('loans.show', $loan) }}" class="btn btn-info ms-2">
                            <i class="bi bi-eye me-2"></i>Ver Detalles
                        </a>
                    </div>
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
        const actualReturnDate = document.getElementById('actual_return_date');

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

            if (actualReturnDate.value && loanDate.value) {
                const loanDateTime = new Date(loanDate.value);
                const actualDateTime = new Date(actualReturnDate.value);

                if (actualDateTime < loanDateTime) {
                    actualReturnDate.setCustomValidity('La fecha real de devolución no puede ser anterior a la fecha de préstamo');
                } else {
                    actualReturnDate.setCustomValidity('');
                }
            }
        }

        loanDate.addEventListener('change', validateDates);
        expectedReturnDate.addEventListener('change', validateDates);
        actualReturnDate.addEventListener('change', validateDates);

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