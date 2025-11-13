{{-- recursos/views/diagrama-de-analisis.blade.php --}}
@extends('layouts.app')

@section('content')
{{-- Encabezado --}}
<header class="mb-5">
    <div class="bg-body-tertiary rounded-3 p-4 p-lg-5 shadow-sm border">
        <h1 class="display-6 fw-semibold text-body-emphasis mb-1">Diagrama de Análisis</h1>
        <p class="lead text-secondary mb-0">Entidades núcleo, relaciones y puntos de control del SGRBU</p>
    </div>
</header>

{{-- Sección 1: ERD --}}
<section class="mb-5">
    <div class="row g-4 align-items-start">
        <div class="col-12 col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 text-body-emphasis mb-3">Entidades y relaciones</h2>

                    <p class="mb-3">
                        El ERD sintetiza el dominio: <strong>Usuario</strong>, <strong>Campus</strong>, <strong>Recurso</strong>,
                        <strong>Préstamo</strong>, <strong>PrestamoRecurso</strong>, <strong>Evidencia</strong>,
                        <strong>Alerta</strong> y <strong>AlertaRegla</strong>.
                    </p>

                    <ul class="mb-3">
                        <li><strong>Integridad:</strong> claves foráneas evitan huérfanos.</li>
                        <li><strong>Unicidad:</strong> emails y códigos de recurso únicos.</li>
                        <li><strong>Trazabilidad:</strong> evidencias y timestamps en hitos.</li>
                        <li><strong>Escalabilidad:</strong> normalización para crecer sin refactor masivo.</li>
                    </ul>

                    <h3 class="h6 text-body-emphasis mt-3 mb-2">Alertas</h3>
                    <ul class="mb-2">
                        <li>
                            <strong>Entidad <code>AlertaRegla</code>:</strong>
                            define <em>condición</em> (p. ej. vencimiento, falta de stock, retrasos consecutivos),
                            <em>severidad</em> (<code>info</code>/<code>warning</code>/<code>danger</code>) y
                            <em>canal</em> (UI, email, in-app, webhook); <code>activa</code>/<code>inactiva</code>.
                        </li>
                        <li>
                            <strong>Entidad <code>Alerta</code>:</strong>
                            instancia generada por una regla; campos sugeridos:
                            <code>titulo</code>, <code>descripcion</code>, <code>severity</code>,
                            <code>status</code> (<code>abierta</code>/<code>en_progreso</code>/<code>resuelta</code>/<code>descartada</code>),
                            <code>read_at</code>, <code>resolved_at</code>.
                        </li>
                    </ul>

                    <h4 class="h6 text-secondary mt-3 mb-2">Relaciones (aplican al ERD)</h4>
                    <ul class="mb-3">
                        <li><code>AlertaRegla</code> <strong>1—N</strong> <code>Alerta</code> (una regla genera muchas alertas).</li>
                        <li><code>Alerta</code> <strong>N—1</strong> <code>Usuario</code> (destinatario/propietario de la alerta).</li>
                        <li>
                            <code>Alerta</code> <strong>N—1</strong> contexto opcional:
                            <code>Préstamo</code> <em>o</em> <code>PrestamoRecurso</code> <em>o</em> <code>Recurso</code>
                            (para anclar el evento a un objeto del dominio).
                        </li>
                        <li>Índices por <code>status</code>, <code>severity</code>, <code>usuario_id</code> y fechas para consultas rápidas.</li>
                    </ul>

                    <div class="small text-secondary">
                        Orígenes: jobs de vencimiento, validaciones de dominio y eventos (aprobación, activación, devolución).
                        Las alertas priorizan por severidad y enrutan por rol/canal.
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-lg-7">
            <div class="position-relative">
                <figure class="figure d-block text-center m-0">
                    <img
                        id="diagrama-de-entidades-relaciones"
                        src="{{ asset('images/welcome/EntidadesRelaciones.svg') }}"
                        class="figure-img img-fluid rounded-3 shadow-sm w-100"
                        style="max-height: 480px; object-fit: contain;"
                        alt="Diagrama de Entidades y Relaciones">
                    <figcaption class="figure-caption text-center">
                        ERD del SGRBU: relaciones entre entidades núcleo.
                    </figcaption>
                </figure>

                {{-- Botón de descarga (overlay) --}}
                <div class="position-absolute top-0 end-0 m-2">
                    <a
                        href="{{ asset('images/welcome/EntidadesRelaciones.svg') }}"
                        download="EntidadesRelaciones.svg"
                        class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-download me-1"></i><span class="d-none d-sm-inline">Descargar SVG</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Sección 2: Puntos de control --}}
<section class="mb-5">
    <div class="row g-4 align-items-start">
        <div class="col-12 col-lg-7 order-lg-2">
            <div class="position-relative">
                <figure class="figure d-block text-center m-0">
                    <img
                        id="diagrama-de-puntos-control"
                        src="{{ asset('images/welcome/PuntosControl.svg') }}"
                        class="figure-img img-fluid rounded-3 shadow-sm w-100"
                        style="max-height: 420px; object-fit: contain;"
                        alt="Diagrama de Puntos de Control">
                    <figcaption class="figure-caption text-center">
                        Máquina de estados: pendiente → aprobado → activo → (vencido) → completado; cancelado como salida alternativa.
                    </figcaption>
                </figure>

                {{-- Botón de descarga (overlay) --}}
                <div class="position-absolute top-0 end-0 m-2">
                    <a
                        href="{{ asset('images/welcome/PuntosControl.svg') }}"
                        download="PuntosControl.svg"
                        class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-download me-1"></i><span class="d-none d-sm-inline">Descargar SVG</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5 order-lg-1">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 text-body-emphasis mb-3">Puntos de control</h2>
                    <ol class="mb-3">
                        <li><strong>Aprobación:</strong> <code>pendiente</code> → <code>aprobado</code> (staff/admin).</li>
                        <li><strong>Activación:</strong> entrega del primer recurso → <code>activo</code>.</li>
                        <li><strong>Devolución:</strong> registrar <code>actual_return_date</code> → <code>completado</code>.</li>
                        <li><strong>Vencimiento:</strong> excede <code>expected_return_date</code> → <code>vencido</code>.</li>
                    </ol>
                    <ul class="mb-3">
                        <li><strong>Auditoría:</strong> evidencias en entrega/devolución.</li>
                        <li><strong>Validación:</strong> evita transiciones inválidas.</li>
                        <li><strong>KPIs:</strong> aprobación ágil y devoluciones en tiempo.</li>
                    </ul>
                    <div class="small text-secondary">
                        Alinea permisos, UI/UX y jobs de marcación de vencidos.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection