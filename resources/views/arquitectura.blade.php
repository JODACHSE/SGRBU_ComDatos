@extends('layouts.app')

@section('title', 'Arquitectura')

@section('content')
<main class="container py-4">
    <header class="mb-4">
        <h1 class="h3 mb-1">Arquitectura de la solución</h1>
        <p class="text-muted mb-0">Capas, tecnologías y empaquetado de assets.</p>
    </header>

    <section class="row g-4">
        <div class="col-12 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6">Presentación</h2>
                    <ul class="mb-0">
                        <li>Blade + Bootstrap 5</li>
                        <li>Componentes parciales reutilizables</li>
                        <li>Accesibilidad y responsive</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6">Aplicación</h2>
                    <ul class="mb-0">
                        <li>Laravel 12</li>
                        <li>Policies por rol</li>
                        <li>Form Requests para validar</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6">Dominio</h2>
                    <ul class="mb-0">
                        <li>Usuarios, sedes, programas</li>
                        <li>Recursos, préstamos, evidencias</li>
                        <li>Estados y transiciones</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h6">Infraestructura</h2>
                    <ul class="mb-0">
                        <li>MySQL/MariaDB</li>
                        <li>Storage público para evidencias</li>
                        <li>Colas opcionales para envíos</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <h2 class="h5">Ciclo de assets con Vite</h2>
        <div class="card">
            <div class="card-body">
                @verbatim
                <pre class="bg-light p-3 rounded small mb-0">
                <!-- layouts/app.blade.php -->
                @vite(['resources/sass/app.scss', 'resources/js/app.js'])
                </pre>
                @endverbatim
                <p class="form-text mt-2">El manifest se publica en <code>public/build/manifest.json</code>.</p>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <h2 class="h5">Diagramas</h2>
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <figure class="mb-0">
                    <img class="img-fluid rounded shadow-sm" src="{{ asset('welcome/ModeloBaseDeDatos.svg') }}" alt="Diagrama del modelo de base de datos" loading="lazy">
                    <figcaption class="form-text mt-2">Modelo de base de datos.</figcaption>
                </figure>
            </div>
            <div class="col-12 col-md-6">
                <figure class="mb-0">
                    <img class="img-fluid rounded shadow-sm" src="{{ asset('welcome/ModeloDeClases.svg') }}" alt="Diagrama del modelo de clases Eloquent" loading="lazy">
                    <figcaption class="form-text mt-2">Modelo de clases.</figcaption>
                </figure>
            </div>
        </div>
    </section>
</main>
@endsection