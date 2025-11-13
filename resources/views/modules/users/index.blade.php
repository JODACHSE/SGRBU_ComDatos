@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="container-fluid">
    <x-alert />

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">
                <i class="bi bi-people-fill me-2"></i>Gestión de Usuarios
            </h5>
        </div>
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Nuevo Usuario
                    </a>
                    <a href="{{ route('users.trashed') }}" class="btn btn-warning ms-2">
                        <i class="bi bi-trash me-2"></i>Papelera
                    </a>
                    @endif
                </div>
                <div class="col-md-6">
                    <form action="{{ route('users.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Buscar usuarios..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            @if($users->count() > 0)
            <div class="table-responsive">
                <x-table>
                    <x-slot name="header">
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Programa</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </x-slot>

                    @foreach($users as $user)
                    <tr>
                        <td class="fw-bold">{{ $user->id }}</td>
                        <td>
                            {{ $user->name }} {{ $user->lastname }}
                            @if($user->second_name || $user->second_lastname)
                            <br><small class="text-muted">{{ $user->second_name }} {{ $user->second_lastname }}</small>
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge 
                                @if($user->role === 'admin') bg-danger
                                @elseif($user->role === 'staff') bg-warning text-dark
                                @elseif($user->role === 'profesor') bg-info
                                @else bg-success @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            @if($user->is_active)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            @if($user->campusProgram)
                            <small>{{ $user->campusProgram->program->name ?? 'N/A' }}</small>
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('users.show', $user) }}" class="btn btn-info" title="Ver detalles">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if(Auth::user()->role === 'admin')
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Eliminar"
                                        onclick="return confirm('¿Está seguro de eliminar este usuario?')">
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
                <x-pagination :paginator="$users" />
            </div>
            @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron usuarios.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection