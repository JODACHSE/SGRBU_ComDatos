@extends('layouts.app')

@section('title', 'Gestión de Alertas')

@section('content')
<div class="container-fluid">
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="bi bi-exclamation-triangle me-2"></i>Gestión de Alertas
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('alerts.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Alerta
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ route('alerts.trashed') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-trash me-2"></i>Papelera
                    </a>
                </div>
            </div>

            @if($alerts->count() > 0)
            <x-table>
                <x-slot name="header">
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Préstamo</th>
                    <th>Estado</th>
                    <th>Descripción</th>
                    <th>Fecha Reporte</th>
                    <th>Acciones</th>
                </x-slot>

                @foreach($alerts as $alert)
                <tr>
                    <td class="fw-bold">{{ $alert->id }}</td>
                    <td>{{ $alert->user->name }}</td>
                    <td>
                        <small class="text-muted">Préstamo #{{ $alert->loan_id }}</small>
                    </td>
                    <td>
                        @if($alert->alert_status == 'reportado')
                        <span class="badge bg-danger">Reportado</span>
                        @elseif($alert->alert_status == 'en_revision')
                        <span class="badge bg-warning">En Revisión</span>
                        @else
                        <span class="badge bg-success">Resuelto</span>
                        @endif
                    </td>
                    <td>
                        <span title="{{ $alert->description }}">
                            {{ Str::limit($alert->description, 50) }}
                        </span>
                    </td>
                    <td>{{ $alert->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('alerts.show', $alert) }}"
                                class="btn btn-info" title="Ver detalles">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('alerts.edit', $alert) }}"
                                class="btn btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('alerts.destroy', $alert) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('¿Está seguro de eliminar esta alerta?')">
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

            <div class="mt-3">
                {{ $alerts->links() }}
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron alertas registradas.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection