@extends('layouts.app')

@section('title', 'Gestión de Recursos')

@section('content')
<div class="container-fluid">
    {{-- Alertas --}}
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-box-seam me-2"></i>Inventario de Recursos
                </h5>
                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                <a href="{{ route('resources.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Nuevo Recurso
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if($resources->count() > 0)
            <div class="table-responsive">
                <x-table>
                    <x-slot name="header">
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Sede</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </x-slot>

                    @foreach($resources as $resource)
                    <tr>
                        <td class="fw-bold">{{ $resource->id }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $resource->resource_code }}</span>
                        </td>
                        <td>{{ $resource->name }}</td>
                        <td>
                            <small class="text-muted">{{ $resource->campus->municipality ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $resource->resourceType->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">{{ $resource->resourceStatus->name ?? 'N/A' }}</span>
                        </td>
                        <td>{{ Str::limit($resource->description, 50) ?? 'N/A' }}</td>
                        <td>{{ $resource->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('resources.show', $resource) }}"
                                    class="btn btn-info"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                                <a href="{{ route('resources.edit', $resource) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('resources.destroy', $resource) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de que desea eliminar este recurso?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger"
                                        title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </x-table>
            </div>

            <div class="mt-3">
                {{-- Paginación --}}
                <x-pagination :paginator="$resources" />
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron recursos en el inventario.
                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                <div class="mt-2">
                    <a href="{{ route('resources.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Agregar Primer Recurso
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Script para confirmaciones --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmación antes de eliminar
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('¿Está seguro de que desea eliminar este recurso? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection