@extends('layouts.app')

@section('title', 'Gestión de Sedes Universitarias')

@section('content')
<div class="container-fluid">
    {{-- Alertas --}}
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-building me-2"></i>Sistema de Gestión de Sedes Universitarias
                </h5>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('campuses.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Nueva Sede
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if($campuses->count() > 0)
            <div class="table-responsive">
                <x-table>
                    <x-slot name="header">
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th>Dirección</th>
                        <th>Programas</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </x-slot>

                    @foreach($campuses as $campus)
                    <tr>
                        <td class="fw-bold">{{ $campus->id }}</td>
                        <td>
                            <span class="badge bg-info">{{ $campus->campus_type }}</span>
                        </td>
                        <td>{{ $campus->department }}</td>
                        <td>{{ $campus->municipality }}</td>
                        <td>{{ $campus->address }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $campus->programs_count ?? 0 }}</span>
                        </td>
                        <td>
                            @if($campus->is_active)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>{{ $campus->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('campuses.show', $campus) }}"
                                    class="btn btn-info"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(auth()->user()->role === 'admin')
                                <a href="{{ route('campuses.edit', $campus) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('campuses.destroy', $campus) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de que desea eliminar esta sede?')">
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
                <x-pagination :paginator="$campuses" />
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron sedes universitarias registradas.
                @if(auth()->user()->role === 'admin')
                <div class="mt-2">
                    <a href="{{ route('campuses.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Crear Primera Sede
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
                if (!confirm('¿Está seguro de que desea eliminar esta sede? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection