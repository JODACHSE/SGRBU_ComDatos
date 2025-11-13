{{-- resources/views/modelos.blade.php --}}
@extends('layouts.app')

@section('content')
{{-- Hero / encabezado --}}
<header class="mb-5">
    <div class="bg-body-tertiary rounded-3 p-4 p-lg-5 shadow-sm border d-flex align-items-center justify-content-between gap-3">
        <div>
            <h1 class="display-6 fw-semibold text-body-emphasis mb-1">Modelos del Sistema</h1>
            <p class="lead text-secondary mb-0">Arquitectura, dominio y flujos del SGRBU</p>
        </div>
        <div class="d-none d-md-block">
            <img
                src="{{ asset('images/global/imagotipo/IMAGOTIPO HORIZONTAL COLOR.png') }}"
                alt="Imagotipo"
                class="img-fluid"
                style="max-height:56px;object-fit:contain">
        </div>
    </div>
</header>

{{-- Navegación por pestañas (tabs) --}}
<ul class="nav nav-tabs mb-4" id="modelosTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="tab-arq" data-bs-toggle="tab" data-bs-target="#pane-arq" type="button" role="tab" aria-controls="pane-arq" aria-selected="true">
            Arquitectura
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-erd" data-bs-toggle="tab" data-bs-target="#pane-erd" type="button" role="tab" aria-controls="pane-erd" aria-selected="false">
            Entidades/Relaciones (ERD)
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-bd" data-bs-toggle="tab" data-bs-target="#pane-bd" type="button" role="tab" aria-controls="pane-bd" aria-selected="false">
            Modelo de BD
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-clases" data-bs-toggle="tab" data-bs-target="#pane-clases" type="button" role="tab" aria-controls="pane-clases" aria-selected="false">
            Modelo de Clases
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab-pc" data-bs-toggle="tab" data-bs-target="#pane-pc" type="button" role="tab" aria-controls="pane-pc" aria-selected="false">
            Puntos de Control
        </button>
    </li>
</ul>

<div class="tab-content" id="modelosTabsContent">
    {{-- Pane: Arquitectura --}}
    <div class="tab-pane fade show active" id="pane-arq" role="tabpanel" aria-labelledby="tab-arq">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7">
                <div class="position-relative">
                    <figure class="figure d-block text-center m-0">
                        <img
                            src="{{ asset('images/welcome/Arquitectura.svg') }}"
                            alt="Arquitectura del sistema"
                            class="figure-img img-fluid rounded-3 shadow-sm w-100"
                            style="max-height:520px;object-fit:contain">
                        <figcaption class="figure-caption text-center">Capas de presentación, aplicación y datos, con componentes transversales (auth, autorización, auditoría).</figcaption>
                    </figure>
                    <div class="position-absolute top-0 end-0 m-2">
                        <a href="{{ asset('images/welcome/Arquitectura.svg') }}" download="Arquitectura.svg" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i><span class="d-none d-sm-inline">Descargar SVG</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 text-body-emphasis mb-3">Resumen</h2>
                        <p class="mb-3">
                            Arquitectura cliente–servidor en <strong>Laravel 12</strong> con Blade + Bootstrap en la UI, controladores HTTP,
                            middleware de autenticación/autorización y persistencia MySQL. Los activos subidos (evidencias) se sirven desde <code>storage/app/public</code> vía symlink.
                        </p>
                        <ul class="mb-0">
                            <li><strong>Escalabilidad:</strong> separación por capas y cache de sesiones.</li>
                            <li><strong>Seguridad:</strong> CSRF, políticas por rol y validación server-side.</li>
                            <li><strong>Reutilización:</strong> API REST potencial y servicios de dominio.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pane: ERD --}}
    <div class="tab-pane fade" id="pane-erd" role="tabpanel" aria-labelledby="tab-erd">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7 order-lg-2">
                <div class="position-relative">
                    <figure class="figure d-block text-center m-0">
                        <img
                            src="{{ asset('images/welcome/EntidadesRelaciones.svg') }}"
                            alt="Entidades y relaciones"
                            class="figure-img img-fluid rounded-3 shadow-sm w-100"
                            style="max-height:520px;object-fit:contain">
                        <figcaption class="figure-caption text-center">Usuario, Campus, Recurso, Préstamo, PrestamoRecurso y Evidencia con claves e integridad referencial.</figcaption>
                    </figure>
                    <div class="position-absolute top-0 end-0 m-2">
                        <a href="{{ asset('images/welcome/EntidadesRelaciones.svg') }}" download="EntidadesRelaciones.svg" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i><span class="d-none d-sm-inline">Descargar SVG</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 order-lg-1">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 text-body-emphasis mb-3">Propósito</h2>
                        <ul class="mb-3">
                            <li><strong>Consistencia:</strong> evita huérfanos y duplicados (p. ej., <code>resource_code</code> único).</li>
                            <li><strong>Trazabilidad:</strong> evidencias asociadas a cada ítem prestado.</li>
                            <li><strong>Escalabilidad:</strong> 3NF y catálogos ampliables.</li>
                        </ul>
                        <div class="small text-secondary">Base para migraciones, seeds y consultas Eloquent eficientes.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pane: Modelo de BD --}}
    <div class="tab-pane fade" id="pane-bd" role="tabpanel" aria-labelledby="tab-bd">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7">
                <div class="position-relative">
                    <figure class="figure d-block text-center m-0">
                        <img
                            src="{{ asset('images/welcome/ModeloBaseDeDatos.svg') }}"
                            alt="Modelo de base de datos"
                            class="figure-img img-fluid rounded-3 shadow-sm w-100"
                            style="max-height:520px;object-fit:contain">
                        <figcaption class="figure-caption text-center">
                            Esquema lógico con índices, claves foráneas y soft deletes donde aplique.
                        </figcaption>
                    </figure>
                    <div class="position-absolute top-0 end-0 m-2">
                        <a href="{{ asset('images/welcome/ModeloBaseDeDatos.svg') }}"
                            download="ModeloBaseDeDatos.svg"
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i>
                            <span class="d-none d-sm-inline">Descargar SVG</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 text-body-emphasis mb-3">Decisiones clave</h2>
                        <ul class="mb-3">
                            <li><strong>Índices:</strong> por estado y búsqueda frecuente (email, <code>resource_code</code>).</li>
                            <li><strong>FK restrictivas:</strong> evitan borrar campus con préstamos activos.</li>
                            <li><strong>Soft deletes:</strong> recuperación sin perder historial.</li>
                        </ul>

                        {{-- Botón de descarga del SQL (simple, para demo/presentación) --}}
                        @env(['local','staging'])
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <a href="{{ asset('sgrbu.sql') }}"
                                download="sgrbu.sql"
                                class="btn btn-primary btn-sm">
                                <i class="bi bi-download me-1"></i> Descargar SQL
                            </a>
                            <span class="text-secondary small">Solo visible en <code>local/staging</code>.</span>
                        </div>
                        @else
                        <div class="alert alert-warning d-flex align-items-center py-2 px-3 small mb-0" role="alert">
                            <i class="bi bi-shield-exclamation me-2"></i>
                            Por seguridad, la descarga del SQL está deshabilitada en producción.
                        </div>
                        @endenv
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Pane: Modelo de Clases --}}
    <div class="tab-pane fade" id="pane-clases" role="tabpanel" aria-labelledby="tab-clases">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7 order-lg-2">
                <div class="position-relative">
                    <figure class="figure d-block text-center m-0">
                        <img
                            src="{{ asset('images/welcome/ModeloDeClases.svg') }}"
                            alt="Modelo de clases"
                            class="figure-img img-fluid rounded-3 shadow-sm w-100"
                            style="max-height:520px;object-fit:contain">
                        <figcaption class="figure-caption text-center">Agregados y responsabilidades orientadas a objetos para reglas del dominio.</figcaption>
                    </figure>
                    <div class="position-absolute top-0 end-0 m-2">
                        <a href="{{ asset('images/welcome/ModeloDeClases.svg') }}" download="ModeloDeClases.svg" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i><span class="d-none d-sm-inline">Descargar SVG</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 order-lg-1">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 text-body-emphasis mb-3">Notas de diseño</h2>
                        <ul class="mb-3">
                            <li><strong>Comandos vs. consultas:</strong> métodos mutables (aprobar/activar) y puros (cálculo de retraso).</li>
                            <li><strong>Enums:</strong> roles y estados tipados para evitar “strings mágicos”.</li>
                            <li><strong>Servicios de dominio:</strong> validación de solicitudes y reglas invariantes.</li>
                        </ul>
                        <div class="small text-secondary">Facilita pruebas unitarias y mantiene la lógica lejos de controladores.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pane: Puntos de Control --}}
    <div class="tab-pane fade" id="pane-pc" role="tabpanel" aria-labelledby="tab-pc">
        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7">
                <div class="position-relative">
                    <figure class="figure d-block text-center m-0">
                        <img
                            src="{{ asset('images/welcome/PuntosControl.svg') }}"
                            alt="Puntos de control"
                            class="figure-img img-fluid rounded-3 shadow-sm w-100"
                            style="max-height:480px;object-fit:contain">
                        <figcaption class="figure-caption text-center">Máquina de estados: pendiente → aprobado → activo → (vencido) → completado; cancelado como salida alternativa.</figcaption>
                    </figure>
                    <div class="position-absolute top-0 end-0 m-2">
                        <a href="{{ asset('images/welcome/PuntosControl.svg') }}" download="PuntosControl.svg" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download me-1"></i><span class="d-none d-sm-inline">Descargar SVG</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 text-body-emphasis mb-3">Justificación</h2>
                        <ol class="mb-3">
                            <li><strong>Aprobación:</strong> control de calidad y permisos (staff/admin).</li>
                            <li><strong>Activación:</strong> inventario en tránsito y bloqueo de duplicados.</li>
                            <li><strong>Devolución/Vencimiento:</strong> KPIs y alertas de cumplimiento.</li>
                        </ol>
                        <div class="small text-secondary">Soporta auditoría, entrenamiento y pruebas end-to-end del flujo.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection