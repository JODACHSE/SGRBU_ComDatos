@extends('layouts.app')

@section('title', 'Gestión de Préstamos')

@section('content')
<div class="container-fluid">
    {{-- Alertas --}}
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-arrow-left-right me-2"></i>Sistema de Gestión de Préstamos
                </h5>
                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                <a href="{{ route('loans.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Nuevo Préstamo
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if($loans->count() > 0)
            <div class="table-responsive">
                <x-table>
                    <x-slot name="header">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Sede</th>
                        <th>Fecha Préstamo</th>
                        <th>Fecha Esperada Devolución</th>
                        <th>Fecha Real Devolución</th>
                        <th>Estado</th>
                        <th>Recursos</th>
                        <th>Acciones</th>
                    </x-slot>

                    @foreach($loans as $loan)
                    <tr>
                        <td class="fw-bold">{{ $loan->id }}</td>
                        <td>
                            <small>{{ $loan->user->name ?? 'N/A' }}</small>
                            <br>
                            <span class="badge bg-secondary">{{ $loan->user->role ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $loan->campus->municipality ?? 'N/A' }}</small>
                        </td>
                        <td>{{ $loan->loan_date->format('d/m/Y H:i') }}</td>
                        <td>{{ $loan->expected_return_date->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($loan->actual_return_date)
                            <span class="badge bg-success">{{ $loan->actual_return_date->format('d/m/Y H:i') }}</span>
                            @else
                            <span class="badge bg-warning">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            @switch($loan->loan_status)
                            @case('pendiente')
                            <span class="badge bg-secondary">Pendiente</span>
                            @break
                            @case('aprovado')
                            <span class="badge bg-info">Aprobado</span>
                            @break
                            @case('activo')
                            <span class="badge bg-primary">Activo</span>
                            @break
                            @case('completado')
                            <span class="badge bg-success">Completado</span>
                            @break
                            @case('vencido')
                            <span class="badge bg-danger">Vencido</span>
                            @break
                            @case('cancelado')
                            <span class="badge bg-dark">Cancelado</span>
                            @break
                            @endswitch
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $loan->loanResources->count() }} recursos</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('loans.show', $loan) }}"
                                    class="btn btn-info"
                                    title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Solo admin/staff pueden editar --}}
                                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                                <a href="{{ route('loans.edit', $loan) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Botón para marcar como devuelto --}}
                                @if($loan->loan_status !== 'completado' && !$loan->actual_return_date)
                                <form action="{{ route('loans.markAsReturned', $loan) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de que desea marcar este préstamo como devuelto?')">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-success"
                                        title="Marcar como devuelto">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('loans.destroy', $loan) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de que desea eliminar este préstamo?')">
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
                <x-pagination :paginator="$loans" />
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron préstamos registrados.
                @if(in_array(auth()->user()->role, ['admin', 'staff']))
                <div class="mt-2">
                    <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Crear Primer Préstamo
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
                if (!confirm('¿Está seguro de que desea eliminar este préstamo? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });

        // Confirmación antes de marcar como devuelto
        const returnForms = document.querySelectorAll('form[action*="markAsReturned"]');
        returnForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('¿Está seguro de que desea marcar este préstamo como devuelto? Esta acción cambiará el estado de los recursos a "Disponible".')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
@endsection