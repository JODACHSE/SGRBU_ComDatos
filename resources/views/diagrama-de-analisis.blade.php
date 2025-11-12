@extends('layouts.app')

@section('title', 'Diagrama de análisis')

@section('content')
<main class="container py-4">
    <header class="mb-4">
        <h1 class="h3 mb-1">Diagrama de análisis</h1>
        <p class="text-muted mb-0">Relaciones y puntos de control del proceso.</p>
    </header>

    <section class="row g-4">
        <div class="col-12 col-lg-7">
            <figure class="mb-0">
                <img class="img-fluid rounded shadow-sm" src="{{ asset('welcome/ModeloDeClases.svg') }}" alt="Análisis: clases y asociaciones principales del dominio de préstamos" loading="lazy">
                <figcaption class="form-text mt-2">Clases y asociaciones.</figcaption>
            </figure>
        </div>
        <div class="col-12 col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6">Puntos de control</h2>
                    <ol class="mb-3">
                        <li>Aprobación del préstamo</li>
                        <li>Entrega por ítem con evidencia</li>
                        <li>Devolución por ítem con evidencia</li>
                        <li>Cierre y actualización de estados</li>
                    </ol>
                    <h3 class="h6">Reglas críticas</h3>
                    <ul class="mb-0">
                        <li>Recursos no se duplican si están aprobados o activos</li>
                        <li>Vencidos si superan la fecha esperada</li>
                        <li>Filtros por sede para visibilidad</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <h2 class="h5">Modelo de datos de apoyo</h2>
        <figure class="mb-0">
            <img class="img-fluid rounded shadow-sm" src="{{ asset('welcome/ModeloBaseDeDatos.svg') }}" alt="Apoyo: diagrama del modelo de base de datos con tablas de usuarios, recursos, préstamos y evidencias" loading="lazy">
            <figcaption class="form-text mt-2">Modelo de base de datos.</figcaption>
        </figure>
    </section>
</main>
@endsection