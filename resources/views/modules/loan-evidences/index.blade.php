@extends('layouts.app')

@section('title', 'Gestión de Evidencias de Préstamos')

@section('content')
<div class="container-fluid">
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-camera-fill me-2"></i>Gestión de Evidencias de Préstamos
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('loan-evidences.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Nueva Evidencia
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ route('loan-evidences.trashed') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-trash me-2"></i>Papelera
                    </a>
                </div>
            </div>

            @if($evidences->count() > 0)
            <x-table>
                <x-slot name="header">
                    <th>ID</th>
                    <th>Préstamo</th>
                    <th>Recurso</th>
                    <th>Tipo</th>
                    <th>Evidencia</th>
                    <th>Notas</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </x-slot>

                @foreach($evidences as $evidence)
                <tr>
                    <td class="fw-bold">{{ $evidence->id }}</td>
                    <td>
                        <small class="text-muted">Préstamo #{{ $evidence->loanResource->loan_id }}</small>
                        <br>
                        <small>{{ $evidence->loanResource->loan->user->name }}</small>
                    </td>
                    <td>{{ $evidence->loanResource->resource->name }}</td>
                    <td>
                        @if($evidence->loan_type == 'prestamo')
                            <span class="badge bg-info">Préstamo</span>
                        @else
                            <span class="badge bg-warning">Devolución</span>
                        @endif
                    </td>
                    <td>
                        @if($evidence->photo_path)
                        <a href="{{ $evidence->photo_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i>Ver Foto
                        </a>
                        @else
                        <span class="text-muted">Sin foto</span>
                        @endif
                    </td>
                    <td>
                        <span title="{{ $evidence->notes }}">
                            {{ Str::limit($evidence->notes, 30) }}
                        </span>
                    </td>
                    <td>{{ $evidence->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('loan-evidences.show', $evidence) }}" 
                               class="btn btn-info" title="Ver detalles">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('loan-evidences.edit', $evidence) }}" 
                               class="btn btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('loan-evidences.destroy', $evidence) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Está seguro de eliminar esta evidencia?')">
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
                {{ $evidences->links() }}
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron evidencias registradas.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection