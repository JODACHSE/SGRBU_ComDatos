<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Gestión de Recursos') - Universidad de Cundinamarca</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss','resources/js/app.js'])

    @stack('styles')
</head>

<body class="d-flex flex-column h-100">
    {{-- Navbar --}}
    <x-navbar />

    {{-- Modal de Auth --}}
    <x-auth-modal />

    <div class="container-fluid grow d-flex flex-column p-0">
        <div class="row g-0 grow">
            @auth
            <aside class="col-auto">
                <x-sidebar />
            </aside>
            @endauth

            {{-- Contenido principal --}}
            <main class="col d-flex flex-column px-3 px-lg-4 py-3">
                <div class="grow">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Autoabrir modal de auth --}}
    @php
    $tab = request('auth_tab');
    if (!$tab && $errors->any()) {
    $registerError = (
    $errors->has('name') || $errors->has('lastname') || $errors->has('password_confirmation') ||
    $errors->has('gender_id') || $errors->has('document_type_id') || $errors->has('campus_id') ||
    $errors->has('academic_program_id') || $errors->has('academic_status') || $errors->has('identification_number')
    );
    $tab = ($registerError || old('name')) ? 'register' : 'login';
    }
    if (!$tab && session('status')) { $tab = 'reset'; }
    @endphp

    @if($tab)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('authModal');
            if (!el || !window.bootstrap) return;
            const m = new bootstrap.Modal(el);
            m.show();
            const btn = document.querySelector(`[data-bs-target="#tab-{{ $tab }}"]`);
            if (btn) new bootstrap.Tab(btn).show();
        });
    </script>
    @endif

    @stack('scripts')
</body>

</html>