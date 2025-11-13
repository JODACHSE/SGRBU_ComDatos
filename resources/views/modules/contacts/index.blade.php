@extends('layouts.app')

@section('title', 'Gestión de Contactos')

@section('content')
<div class="container-fluid">
    {{-- Alertas --}}
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-telephone-fill me-2"></i>Gestión de Contactos
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
                    </a>
                </div>
                <a href="{{ route('contacts.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Nuevo Contacto
                </a>
            </div>

            @if ($contacts->count() > 0)
            <div class="table-responsive">
                <x-table>
                    <x-slot name="header">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Tipo de Contacto</th>
                        <th>Valor</th>
                        <th>Principal</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </x-slot>

                    @foreach ($contacts as $contact)
                    <tr>
                        <td class="fw-bold">{{ $contact->id }}</td>
                        <td>
                            {{ $contact->user->name }} {{ $contact->user->lastname }}
                            <br>
                            <small class="text-muted">{{ $contact->user->identification_number }}</small>
                        </td>
                        <td>{{ $contact->contactType->name }}</td>
                        <td>{{ $contact->contact_value }}</td>
                        <td>
                            @if ($contact->is_principal)
                            <span class="badge bg-success">Sí</span>
                            @else
                            <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            @if ($contact->is_active)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('contacts.show', $contact) }}"
                                    class="btn btn-info"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('contacts.edit', $contact) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('contacts.destroy', $contact) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar este contacto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </x-table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="mb-0">Mostrando {{ $contacts->firstItem() }} a {{ $contacts->lastItem() }} de {{ $contacts->total() }} registros</p>
                <x-pagination :paginator="$contacts" />
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>No hay contactos registrados.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection