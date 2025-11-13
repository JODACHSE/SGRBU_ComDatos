@extends('layouts.app')

@section('content')
<div class="min-vh-100 bg-light">
    <!-- Hero Section -->
    <section class="hero-section py-5 bg-primary text-white position-relative overflow-hidden">
        <div class="container position-relative z-1">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Sistema de Gestión de Recursos</h1>
                    <p class="lead mb-4">Diseñado para Bienestar Universitario</p>
                    <p class="mb-5">Una plataforma integral para gestionar préstamos de recursos deportivos, juegos de mesa e instrumentos musicales, entre otros recursos, de manera eficiente y controlada.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#como-funciona" class="btn btn-light btn-lg px-4">
                            <i class="bi bi-card-checklist me-2"></i>Conoce más aquí
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image mt-5 mt-lg-0">
                        <img src="{{ asset('images/global/imagotipo/IMAGOTIPO VERTICAL COLOR.png') }}"
                            alt="Universidad de Cundinamarca"
                            class="img-fluid"
                            style="max-height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Recursos Disponibles</h2>
                <p class="text-muted">Solo el personal autorizado gestiona diferentes tipos de recursos con procesos optimizados</p>
            </div>

            <div class="row g-4">
                <!-- Sports Resources -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-trophy-fill text-warning display-5"></i>
                            </div>
                            <h4 class="card-title">Recursos Deportivos</h4>
                            <p class="card-text text-muted">Balones, raquetas, conos y todo el equipamiento deportivo necesario para actividades físicas.</p>
                            <ul class="list-unstyled mt-3 text-start">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Préstamo directo</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Disponibilidad en tiempo real</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Por sede universitaria</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Board Games -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-joystick text-success display-5"></i>
                            </div>
                            <h4 class="card-title">Juegos de Mesa</h4>
                            <p class="card-text text-muted">Amplia variedad de juegos para entretenimiento y desarrollo de habilidades cognitivas.</p>
                            <ul class="list-unstyled mt-3 text-start">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Reserva anticipada</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Catálogo visual</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Tiempos de préstamo flexibles</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Musical Instruments -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-music-note-beamed text-info display-5"></i>
                            </div>
                            <h4 class="card-title">Instrumentos Musicales</h4>
                            <p class="card-text text-muted">Instrumentos para prácticas y presentaciones, con registro de disponibilidad y mantenimiento.</p>
                            <ul class="list-unstyled mt-3 text-start">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Control de estado</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Entrega por personal autorizado</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Historial de mantenimiento</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="como-funciona" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">¿Cómo Funciona?</h2>
                <p class="text-muted">Sigue estos sencillos pasos para solicitar recursos</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-number bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold mb-3" style="width: 60px; height: 60px;">1</div>
                    <h5>Explora el Catálogo</h5>
                    <p class="text-muted">Revisa los recursos disponibles en tu sede universitaria.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-number bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold mb-3" style="width: 60px; height: 60px;">2</div>
                    <h5>Solicita el Recurso</h5>
                    <p class="text-muted">Selecciona fecha y hora de recogida según disponibilidad.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-number bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold mb-3" style="width: 60px; height: 60px;">3</div>
                    <h5>Recoge tu Recurso</h5>
                    <p class="text-muted">Presenta tu documento institucional al personal autorizado.</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-number bg-primary rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold mb-3" style="width: 60px; height: 60px;">4</div>
                    <h5>Disfruta y Devuelve</h5>
                    <p class="text-muted">Usa el recurso y devuélvelo en el tiempo establecido.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Resource Maintenance Section (replacement for QR system) -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Mantenimiento y Seguridad de los Recursos</h2>
                    <p class="mb-4">Para asegurar el buen uso y durabilidad de los recursos, el sistema integra un módulo de mantenimiento y revisión periódica.</p>

                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="bi bi-tools text-primary display-6"></i>
                        </div>
                        <div>
                            <h5>Revisión Preventiva</h5>
                            <p class="text-muted mb-0">Cada recurso es inspeccionado regularmente por el equipo técnico antes de su préstamo.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="bi bi-file-earmark-text text-primary display-6"></i>
                        </div>
                        <div>
                            <h5>Historial de Uso</h5>
                            <p class="text-muted mb-0">Se mantiene un registro completo de préstamos, devoluciones y observaciones de estado.</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="me-3">
                            <i class="bi bi-person-check text-primary display-6"></i>
                        </div>
                        <div>
                            <h5>Gestión Responsable</h5>
                            <p class="text-muted mb-0">El personal autorizado garantiza el correcto manejo y reporte de cada recurso institucional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <div class="bg-light rounded-3 p-4 shadow-sm">
                        <img src="{{ asset('images/welcome/inventario.png') }}"
                            alt="Mantenimiento de Recursos"
                            class="img-fluid rounded"
                            style="max-width: 350px;">
                        <p class="mt-3 text-muted">Supervisión y control institucional</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Beneficios del Sistema</h2>
                <p class="opacity-75">Ventajas para estudiantes, docentes y personal administrativo</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <i class="bi bi-clock display-4 mb-3"></i>
                    <h5>Ahorro de Tiempo</h5>
                    <p>Digitalización completa del proceso de préstamo, reduciendo tiempos de gestión en un 60%.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-eye display-4 mb-3"></i>
                    <h5>Transparencia Total</h5>
                    <p>Estado de disponibilidad en tiempo real y historial completo de movimientos.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-shield-check display-4 mb-3"></i>
                    <h5>Control de Recursos</h5>
                    <p>Sistema especializado que reduce pérdidas, daños y mejora la trazabilidad.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-2 pt-5 bg-white">
        <div class="container text-center">
            @guest
            <h2 class="fw-bold mb-3">¿Listo para comenzar?</h2>
            <p class="text-muted mb-4">Comunícate con un <strong>miembro autorizado</strong> para obtener acceso a la plataforma y disfruta de todos los recursos disponibles.</p>
            @else
            <a href="{{ url('/home') }}" class="btn btn-primary btn-lg px-4">
                <i class="bi bi-speedometer2 me-2"></i>Ir al Dashboard
            </a>
            @endguest
        </div>
    </section>
</div>
@endsection