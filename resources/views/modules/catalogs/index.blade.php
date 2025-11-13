@extends('layouts.app')

@section('title', 'Gestión de Catálogos')

@section('content')
<div class="container-fluid">
    {{-- Alertas --}}
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-bookmarks-fill me-2"></i>Sistema de Gestión de Catálogos
            </h5>
        </div>
        <div class="card-body">
            {{-- Formulario de selección --}}
            <form action="{{ route('catalogs.index') }}" method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-md-5">
                    <label for="catalog" class="form-label fw-bold">Seleccione un catálogo:</label>
                    <select class="form-select" id="catalog" name="catalog" required>
                        <option value="">-- Seleccione un catálogo --</option>
                        @foreach($catalogs as $catalog)
                        <option value="{{ $catalog }}"
                            {{ $selectedCatalog == $catalog ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $catalog)) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>Mostrar resultado
                    </button>
                </div>
                <div class="col-md-4">
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route($selectedCatalog . '.create') }}" class="btn btn-success w-100">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo registro
                    </a>
                    @endif
                </div>
            </form>

            {{-- Tabla de resultados --}}
            @if(isset($records) && $records->count() > 0)
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="bi bi-list-ul me-2"></i>
                        Registros de {{ ucfirst(str_replace('-', ' ', $selectedCatalog)) }}
                        <span class="badge bg-primary ms-2">{{ $records->total() }}</span>
                    </h6>
                </div>
                <div class="card-body p-0">
                    <x-table>
                        <x-slot name="header">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th>Fecha Actualización</th>
                            <th>Acciones</th>
                        </x-slot>

                        @foreach($records as $record)
                        <tr>
                            <td class="fw-bold">{{ $record->id }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->description ?? 'N/A' }}</td>
                            <td>
                                @if($record->is_active)
                                <span class="badge bg-success">Activo</span>
                                @else
                                <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>{{ $record->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $record->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route($selectedCatalog . '.show', $record) }}"
                                        class="btn btn-info"
                                        title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if(auth()->user()->role === 'admin')
                                    <a href="{{ route($selectedCatalog . '.edit', $record) }}"
                                        class="btn btn-warning"
                                        title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @php
                                    $accion = $record->is_active ? 'inactivar' : 'activar';
                                    $mensajeConfirmacion = "¿Está seguro de que desea {$accion} este registro?";
                                    @endphp
                                    <form action="{{ route('catalogs.toggle-active', [$selectedCatalog, $record->id]) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('{{ $mensajeConfirmacion }}')">
                                        @csrf
                                        <button type="submit"
                                            class="btn {{ $record->is_active ? 'btn-danger' : 'btn-success' }}"
                                            title="{{ $record->is_active ? 'Inactivar' : 'Activar' }}">
                                            <i class="bi {{ $record->is_active ? 'bi-x-circle' : 'bi-check-circle' }}"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </x-table>
                </div>
                <div class="card-footer bg-light">
                    {{-- Paginación --}}
                    <x-pagination :paginator="$records" />
                </div>
            </div>
            @elseif(isset($records) && $records->count() == 0)
            <div class="alert alert-info mt-4 text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron registros para el catálogo seleccionado.
            </div>
            @else
            <div class="alert alert-warning mt-4 text-center">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Por favor, seleccione un catálogo para visualizar los registros.
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Script para confirmaciones --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirmación antes de inactivar/activar
        const toggleForms = document.querySelectorAll('form[action*="toggle-active"]');
        toggleForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const isActive = this.querySelector('button').classList.contains('btn-danger');
                const action = isActive ? 'inactivar' : 'activar';
                if (!confirm(`¿Está seguro de que desea ${action} este registro?`)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection