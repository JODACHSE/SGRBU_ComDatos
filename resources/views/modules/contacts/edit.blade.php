@extends('layouts.app')

@section('title', 'Editar Contacto')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-pencil me-2"></i>Editar Contacto
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('contacts.update', $contact) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label fw-bold">Usuario <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror"
                            id="user_id"
                            name="user_id"
                            required>
                            <option value="">-- Seleccione un usuario --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $contact->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} {{ $user->lastname }} - {{ $user->identification_number }}
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="contact_type_id" class="form-label fw-bold">Tipo de Contacto <span class="text-danger">*</span></label>
                        <select class="form-select @error('contact_type_id') is-invalid @enderror"
                            id="contact_type_id"
                            name="contact_type_id"
                            required>
                            <option value="">-- Seleccione un tipo --</option>
                            @foreach($contactTypes as $contactType)
                            <option value="{{ $contactType->id }}" {{ old('contact_type_id', $contact->contact_type_id) == $contactType->id ? 'selected' : '' }}>
                                {{ $contactType->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('contact_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="contact_value" class="form-label fw-bold">Valor del Contacto <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('contact_value') is-invalid @enderror"
                            id="contact_value"
                            name="contact_value"
                            value="{{ old('contact_value', $contact->contact_value) }}"
                            required
                            placeholder="Ingrese el número de teléfono, email, etc.">
                        @error('contact_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Contacto Principal</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input"
                                type="checkbox"
                                role="switch"
                                id="is_principal"
                                name="is_principal"
                                value="1"
                                {{ old('is_principal', $contact->is_principal) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_principal">
                                Marcar como principal
                            </label>
                        </div>
                        <small class="text-muted">Si está activo, este será el contacto principal del usuario</small>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle me-2"></i>Actualizar Contacto
                        </button>
                        <a href="{{ route('contacts.show', $contact) }}" class="btn btn-info ms-2">
                            <i class="bi bi-eye me-2"></i>Ver Detalles
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection