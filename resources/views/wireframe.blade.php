@extends('layouts.app')

@section('title', 'Wireframes')

@section('content')
<main class="container py-4">
    <header class="mb-4">
        <h1 class="h3 mb-1">Wireframes funcionales</h1>
        <p class="text-muted mb-0">Estructura base de pantallas clave.</p>
    </header>

    {{-- Dashboard --}}
    <section class="mb-5">
        <h2 class="h5 mb-3">Dashboard</h2>
        <div class="row g-3">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="placeholder-glow">
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-4"></span>
                        </div>
                        <p class="text-muted mb-0">Préstamos activos</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="placeholder-glow">
                            <span class="placeholder col-5"></span>
                            <span class="placeholder col-7"></span>
                        </div>
                        <p class="text-muted mb-0">Vencen hoy</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="placeholder-glow">
                            <span class="placeholder col-8"></span>
                            <span class="placeholder col-3"></span>
                        </div>
                        <p class="text-muted mb-0">Recursos en uso</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Listado de préstamos --}}
    <section class="mb-5">
        <h2 class="h5 mb-3">Préstamos</h2>
        <div class="card">
            <div class="card-body">
                <form class="row g-2 align-items-end mb-3" method="GET" action="#">
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="q">Buscar</label>
                        <input id="q" name="q" type="search" class="form-control" placeholder="Usuario, código de recurso…">
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label" for="estado">Estado</label>
                        <select id="estado" name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option>pendiente</option>
                            <option>aprobado</option>
                            <option>activo</option>
                            <option>completado</option>
                            <option>vencido</option>
                            <option>cancelado</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label" for="sede">Sede</label>
                        <select id="sede" name="sede" class="form-select">
                            <option value="">Todas</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2 d-grid">
                        <button class="btn btn-primary" type="submit">Filtrar</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Usuario</th>
                                <th>Sede</th>
                                <th>Recursos</th>
                                <th>Entrega</th>
                                <th>Devolución esperada</th>
                                <th>Estado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i=1; $i<=5; $i++)
                                <tr>
                                <td>#00{{ $i }}</td>
                                <td class="text-nowrap">usuario{{ $i }}@demo</td>
                                <td>Campus {{ $i }}</td>
                                <td>2 ítems</td>
                                <td>2025-11-01</td>
                                <td>2025-11-15</td>
                                <td><span class="badge bg-secondary">pendiente</span></td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="#">Ver</a>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Detalle de préstamo --}}
    <section class="mb-5">
        <h2 class="h5 mb-3">Detalle de préstamo</h2>
        <div class="row g-3">
            <div class="col-12 col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6">Ítems</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Recurso ABC-001 <span class="badge bg-light text-dark">entregado</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Recurso ABC-002 <span class="badge bg-warning text-dark">pendiente</span>
                            </li>
                        </ul>
                        <p class="form-text mt-2">Las evidencias se adjuntan por ítem al entregar y devolver.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="h6">Acciones</h3>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-success" type="button">Aprobar</button>
                            <button class="btn btn-outline-secondary" type="button">Marcar entrega</button>
                            <button class="btn btn-outline-primary" type="button">Registrar devolución</button>
                            <button class="btn btn-outline-danger" type="button">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Inventario --}}
    <section>
        <h2 class="h5 mb-3">Inventario</h2>
        <div class="row g-3">
            @for ($i=1; $i<=6; $i++)
                <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3 class="h6 mb-1">Recurso {{ $i }}</h3>
                            <span class="badge bg-success">disponible</span>
                        </div>
                        <p class="mb-2 text-muted">Tipo X • Campus Y</p>
                        <button class="btn btn-sm btn-outline-primary">Ver detalle</button>
                    </div>
                </div>
        </div>
        @endfor
        </div>
    </section>
</main>
@endsection