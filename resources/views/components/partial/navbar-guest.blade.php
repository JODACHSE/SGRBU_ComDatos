<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/global/WololoIcon.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            {{ config('app.name', 'Laravel') }}
        </a>

        {{-- Navbar Toggler --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wireframe') }}">Wireframe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('diagrama') }}">Diagrama</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Modelos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('modelos') }}#dominio">Dominio</a></li>
                        <li><a class="dropdown-item" href="{{ route('modelos') }}#comportamiento">Comportamiento</a></li>
                        <li><a class="dropdown-item" href="{{ route('modelos') }}#base-de-datos">Base de datos</a></li>
                        <li><a class="dropdown-item" href="{{ route('modelos') }}#clases-back-end">Clases (Back-end)</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('arquitectura') }}">Arquitectura</a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#authModal">
                        Acceder
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>