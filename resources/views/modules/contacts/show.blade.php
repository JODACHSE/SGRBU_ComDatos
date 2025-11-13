@extends('layouts.app')

@section('title', 'Detalles del Contacto')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-eye-fill me-2"></i>Detalles del Contacto
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">ID:</label>
                    <p class="form-control-plaintext">{{ $contact->id }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Usuario:</label>
                    <p class="form-control-plaintext">
                        {{ $contact->user->name }} {{ $contact->user->lastname }}
                        <br>
                        <small class="text-muted">{{ $contact->user->identification_number }}</small>
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Tipo de Contacto:</label>
                    <p class="form-control-plaintext">{{ $contact->contactType->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Valor del Contacto:</label>
                    <p class="form-control-plaintext">{{ $contact->contact_value }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Contacto Principal:</label>
                    <p>
                        @if($contact->is_principal)
                        <span class="badge bg-success">Sí</span>
                        @else
                        <span class="badge bg-secondary">No</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Estado:</label>
                    <p>
                        @if($contact->is_active)
                        <span class="badge bg-success">Activo</span>
                        @else
                        <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Fecha de Creación:</label>
                    <p class="form-control-plaintext">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-primary">Última Actualización:</label>
                    <p class="form-control-plaintext">{{ $contact->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al listado
                </a>

                <div class="btn-group">
                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Editar Contacto
                    </a>
                    <form action="{{ route('contacts.destroy', $contact) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('¿Está seguro de eliminar este contacto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ms-2">
                            <i class="bi bi-trash me-2"></i>Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection