@extends('layouts.app')

@section('title', 'Gestión de Programas Académicos')

@section('content')
<div class="container-fluid">
    {{-- Alertas --}}
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-book me-2"></i>Sistema de Gestión de Programas Académicos
                </h5>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('programs.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Nuevo Programa
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if($programs->count() > 0)
            <div class="table-responsive">
                <x-table>
                    <x-slot name="header">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo de Programa</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </x-slot>

                    @foreach($programs as $program)
                    <tr>
                        <td class="fw-bold">{{ $program->id }}</td>
                        <td>{{ $program->name }}</td>
                        <td>
                            <span class="badge bg-info">{{ $program->programType->name ?? 'N/A' }}</span>
                        </td>
                        <td>{{ $program->description ?? 'N/A' }}</td>
                        <td>
                            @if($program->is_active)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>{{ $program->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('programs.show', $program) }}"
                                    class="btn btn-info"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(auth()->user()->role === 'admin')
                                <a href="{{ route('programs.edit', $program) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('programs.destroy', $program) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de que desea eliminar este programa?')">
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
                <x-pagination :paginator="$programs" />
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron programas académicos registrados.
                @if(auth()->user()->role === 'admin')
                <div class="mt-2">
                    <a href="{{ route('programs.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Crear Primer Programa
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
                if (!confirm('¿Está seguro de que desea eliminar este programa? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection