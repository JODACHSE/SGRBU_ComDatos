@extends('layouts.app')

@section('title', 'Modelos')

@section('content')
<main class="container py-4">
    <header class="mb-4">
        <h1 class="h3 mb-1">Modelos</h1>
        <p class="text-muted mb-0">Datos, clases, conceptual y estados.</p>
    </header>

    <ul class="nav nav-tabs" id="modelosTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-datos" data-bs-toggle="tab" data-bs-target="#modelo-datos" type="button" role="tab" aria-controls="modelo-datos" aria-selected="true">
                Modelo de datos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-clases" data-bs-toggle="tab" data-bs-target="#modelo-clases" type="button" role="tab" aria-controls="modelo-clases" aria-selected="false">
                Modelo de clases
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-conceptual" data-bs-toggle="tab" data-bs-target="#modelo-conceptual" type="button" role="tab" aria-controls="modelo-conceptual" aria-selected="false">
                Modelo conceptual
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-estados" data-bs-toggle="tab" data-bs-target="#modelo-estados" type="button" role="tab" aria-controls="modelo-estados" aria-selected="false">
                Estados y transiciones
            </button>
        </li>
    </ul>

    <div class="tab-content border-start border-end border-bottom p-3" id="modelosTabsContent">
        {{-- 1) Datos --}}
        <section class="tab-pane fade show active" id="modelo-datos" role="tabpanel" aria-labelledby="tab-datos" tabindex="0">
            <div class="row g-3 align-items-start">
                <div class="col-12 col-lg-9">
                    <figure class="mb-0">
                        <img class="img-fluid rounded shadow-sm" src="{{ asset('welcome/ModeloBaseDeDatos.svg') }}" alt="Diagrama del modelo de base de datos: sedes, programas, usuarios, recursos, préstamos y evidencias" loading="lazy">
                        <figcaption class="form-text mt-2">Modelo de base de datos (SVG).</figcaption>
                    </figure>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h6">Resumen</h2>
                            <ul class="mb-3">
                                <li>Sedes y programas</li>
                                <li>Usuarios y contactos</li>
                                <li>Inventario</li>
                                <li>Préstamos y evidencias</li>
                            </ul>
                            <a class="btn btn-outline-primary w-100" href="{{ asset('welcome/ModeloBaseDeDatos.svg') }}" download>Descargar SVG</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2) Clases --}}
        <section class="tab-pane fade" id="modelo-clases" role="tabpanel" aria-labelledby="tab-clases" tabindex="0">
            <div class="row g-3 align-items-start">
                <div class="col-12 col-lg-9">
                    <figure class="mb-0">
                        <img class="img-fluid rounded shadow-sm" src="{{ asset('welcome/ModeloDeClases.svg') }}" alt="Diagrama de clases Eloquent: User, Loan, Resource, LoanResource y LoanEvidence" loading="lazy">
                        <figcaption class="form-text mt-2">Modelo de clases Eloquent (SVG).</figcaption>
                    </figure>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h6">Relaciones clave</h2>
                            <ul class="mb-3">
                                <li>User ⇢ hasMany Loan</li>
                                <li>Loan ⇢ hasMany LoanResource</li>
                                <li>Resource ⇢ hasMany LoanResource</li>
                                <li>LoanResource ⇢ hasMany LoanEvidence</li>
                            </ul>
                            <a class="btn btn-outline-primary w-100" href="{{ asset('welcome/ModeloDeClases.svg') }}" download>Descargar SVG</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3) Conceptual --}}
        <section class="tab-pane fade" id="modelo-conceptual" role="tabpanel" aria-labelledby="tab-conceptual" tabindex="0">
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="h6">Contexto</h2>
                            <p class="mb-2">Gestión de préstamos de recursos físicos entre sedes y programas.</p>
                            <ul class="mb-0">
                                <li>Inventario por sede y tipo</li>
                                <li>Préstamo con múltiples ítems</li>
                                <li>Evidencias por entrega y devolución</li>
                                <li>Auditoría con timestamps y soft delete</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="h6">Reglas</h2>
                            <ul class="mb-0">
                                <li>Un recurso aprobado o activo no se reasigna</li>
                                <li>Devolución fuera de fecha ⇢ vencido</li>
                                <li>Transición de estado de recurso al activar/cerrar</li>
                                <li>Filtros por sede en listados y reportes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 4) Estados --}}
        <section class="tab-pane fade" id="modelo-estados" role="tabpanel" aria-labelledby="tab-estados" tabindex="0">
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="h6">Préstamo</h2>
                            <ol class="mb-0">
                                <li>pendiente → aprobado → activo → completado</li>
                                <li>pendiente → cancelado</li>
                                <li>activo → vencido</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="h6">Recurso</h2>
                            <ol class="mb-0">
                                <li>disponible → en uso</li>
                                <li>en uso → disponible</li>
                                <li>cambios: mantenimiento o dañado</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>
@endsection