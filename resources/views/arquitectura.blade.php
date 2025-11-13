@extends('layouts.app')

@section('title', 'Arquitectura')

@section('content')
<main class="container py-4">
    <header class="mb-5">
        <div class="bg-body-tertiary rounded-3 p-4 p-lg-5 shadow-sm border">
            <h1 class="display-6 fw-semibold text-body-emphasis mb-1">Arquitectura del Sistema</h1>
            <p class="lead text-secondary mb-0">Arquitectura de capas, tecnologías y componentes del SGRBU</p>
        </div>
    </header>


    <!-- Arquitectura Modelo Cliente-Servidor -->
    <section class="mb-5">
        <h2 class="h4 mb-3">Arquitectura Modelo Cliente-Servidor</h2>

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-primary">
                    <div class="card-header bg-primary text-white">
                        <i class="bi bi-browser-chrome me-2"></i>Presentación
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Blade Templates</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Bootstrap 5</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Vite (SASS/JS)</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Bootstrap Icons</li>
                            <li class="mb-0"><i class="bi bi-check-circle text-success me-2"></i>Responsive Design</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-success">
                    <div class="card-header bg-success text-white">
                        <i class="bi bi-gear-fill me-2"></i>Aplicación
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Laravel 12</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Controllers (HTTP)</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Middleware CheckRole</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Form Validation</li>
                            <li class="mb-0"><i class="bi bi-check-circle text-success me-2"></i>Eloquent ORM</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-info">
                    <div class="card-header bg-info text-white">
                        <i class="bi bi-diagram-3-fill me-2"></i>Dominio
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Usuarios & Roles</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Sedes & Programas</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Recursos</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Préstamos</li>
                            <li class="mb-0"><i class="bi bi-check-circle text-success me-2"></i>Evidencias</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="bi bi-database-fill me-2"></i>Infraestructura
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>MySQL/MariaDB</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Índices & FK</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Soft Deletes</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>File Storage</li>
                            <li class="mb-0"><i class="bi bi-check-circle text-success me-2"></i>Queue System</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diagrama de Flujo -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h3 class="h6 mb-0"><i class="bi bi-diagram-2 me-2"></i>Flujo de Comunicación</h3>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img id="diagrama-de-flujo" src="{{ asset('images/welcome/Arquitectura.svg') }}" class="img-fluid" alt="Diagrama de Flujo" height="400">
                </div>
            </div>
        </div>

        <!-- Por qué es necesario -->
        <div class="alert alert-info">
            <h4 class="alert-heading"><i class="bi bi-info-circle me-2"></i>¿Por qué esta arquitectura?</h4>
            <ul class="mb-0">
                <li><strong>Escalabilidad:</strong> Separación clara permite escalar servidor y BD independientemente</li>
                <li><strong>Mantenibilidad:</strong> Cambios en UI no afectan lógica de negocio</li>
                <li><strong>Seguridad:</strong> Validación en servidor, autenticación centralizada, protección CSRF</li>
                <li><strong>Rendimiento:</strong> Cache de sesiones, lazy loading de relaciones Eloquent</li>
            </ul>
        </div>
    </section>

    <!-- Capas Horizontales -->
    <section class="mb-5">
        <h2 class="h4 mb-3">Capas Horizontales del Sistema</h2>

        <div class="accordion" id="accordionCapas">
            <!-- Autenticación -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAuth">
                        <i class="bi bi-shield-lock me-2"></i>Autenticación y Autorización
                    </button>
                </h2>
                <div id="collapseAuth" class="accordion-collapse collapse show" data-bs-parent="#accordionCapas">
                    <div class="accordion-body">
                        <ul>
                            <li><strong>Laravel/UI:</strong> Sistema de login, password reset y registro</li>
                            <li><strong>Middleware CheckRole:</strong> Control de acceso basado en roles (admin, staff, profesor, estudiante)</li>
                            <li><strong>Session Guards:</strong> Almacenamiento seguro de sesiones en base de datos</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Almacenamiento -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStorage">
                        <i class="bi bi-folder me-2"></i>Almacenamiento de Archivos
                    </button>
                </h2>
                <div id="collapseStorage" class="accordion-collapse collapse" data-bs-parent="#accordionCapas">
                    <div class="accordion-body">
                        <ul>
                            <li><strong>storage/app/public:</strong> Evidencias fotográficas de préstamos y devoluciones</li>
                            <li><strong>Symbolic link:</strong> Acceso público mediante <code>php artisan storage:link</code></li>
                            <li><strong>Validación:</strong> Tamaño máximo y tipos de archivo permitidos</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Auditoría -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAudit">
                        <i class="bi bi-clock-history me-2"></i>Auditoría
                    </button>
                </h2>
                <div id="collapseAudit" class="accordion-collapse collapse" data-bs-parent="#accordionCapas">
                    <div class="accordion-body">
                        <ul>
                            <li><strong>Timestamps automáticos:</strong> created_at y updated_at en todas las tablas</li>
                            <li><strong>Soft Deletes:</strong> deleted_at permite recuperar registros eliminados</li>
                            <li><strong>Trazabilidad completa:</strong> Historial de cambios sin pérdida de información</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ciclo de Assets con Vite -->
    <section class="mb-5">
        <h2 class="h4 mb-3">Ciclo de Assets con Vite</h2>

        <div class="card">
            <div class="card-body">
                <p class="mb-3">Vite compila y empaqueta los assets del proyecto (SASS, JavaScript) de forma optimizada:</p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <h5 class="h6">En layouts/app.blade.php:</h5>
                        <pre class="bg-light p-3 rounded"><code>@verbatim@vite(['resources/sass/app.scss', 'resources/js/app.js'])@endverbatim</code></pre>
                    </div>

                    <div class="col-md-6">
                        <h5 class="h6">Resultado en producción:</h5>
                        <pre class="bg-light p-3 rounded"><code>&lt;link rel="stylesheet" href="/build/assets/app-hash.css"&gt;
&lt;script src="/build/assets/app-hash.js"&gt;</code></pre>
                    </div>
                </div>

                <div class="alert alert-secondary mt-3 mb-0">
                    <p class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        El manifest se publica en <code>public/build/manifest.json</code> para versionado automático
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Diagramas de Referencia -->
    <section class="mb-5">
        <h2 class="h4 mb-3">Diagramas de Referencia</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <i class="bi bi-diagram-3 me-2"></i>Modelo de Base de Datos
                    </div>
                    <div class="card-body">
                        <figure class="mb-0">
                            <img id="diagrama-de-base-de-datos" src="{{ asset('images/welcome/ModeloBaseDeDatos.svg') }}" class="img-fluid" alt="Diagrama de Base de Datos" height="400">
                            <figcaption class="text-muted small mt-2">
                                Estructura completa de tablas, relaciones y llaves foráneas
                            </figcaption>
                        </figure>
                        <a href="{{ asset('welcome/ModeloBaseDeDatos.svg') }}"
                            class="btn btn-outline-primary btn-sm w-100 mt-3"
                            download>
                            <i class="bi bi-download me-2"></i>Descargar SVG
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <i class="bi bi-diagram-2 me-2"></i>Modelo de Clases
                    </div>
                    <div class="card-body">
                        <figure class="mb-0">
                            <img id="diagrama-de-clases" src="{{ asset('images/welcome/ModeloDeClases.svg') }}" class="img-fluid" alt="Diagrama de Clases" height="400">
                            <figcaption class="text-muted small mt-2">
                                Clases Eloquent con atributos, métodos y relaciones
                            </figcaption>
                        </figure>
                        <a href="{{ asset('welcome/ModeloDeClases.svg') }}"
                            class="btn btn-outline-primary btn-sm w-100 mt-3"
                            download>
                            <i class="bi bi-download me-2"></i>Descargar SVG
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mejoras Futuras -->
    <section>
        <h2 class="h4 mb-3">Optimizaciones Implementadas y Futuras</h2>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-success h-100">
                    <div class="card-header bg-success text-white">
                        <i class="bi bi-check-circle me-2"></i>Implementado
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Normalización 3NF de base de datos</li>
                            <li>Índices en campos de búsqueda frecuente</li>
                            <li>Soft deletes para auditoría</li>
                            <li>Middleware de roles</li>
                            <li>Eager loading de relaciones</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-warning h-100">
                    <div class="card-header bg-warning text-dark">
                        <i class="bi bi-clock me-2"></i>Próximas Mejoras
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Job programado para vencimientos</li>
                            <li>Caché de consultas frecuentes (Redis)</li>
                            <li>API REST para apps móviles</li>
                            <li>Sistema de notificaciones push</li>
                            <li>Reportes con gráficos (Chart.js)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection