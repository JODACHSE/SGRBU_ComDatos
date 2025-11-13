<nav id="sidebar" class="bg-dark text-white vh-100 sticky-top">
    <div class="sidebar-header p-2 border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 text-truncate">
                <i class="bi bi-grid-3x3-gap"></i>
                <span class="sidebar-text">Menú</span>
            </h6>
            <button class="btn btn-sm btn-outline-light d-lg-none" id="sidebarToggle">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <div class="p-2">
        @php $user = auth()->user(); @endphp

        {{-- Dashboard --}}
        <div class="mb-1">
            <a href="{{ route('home') }}" class="btn btn-outline-light w-100 text-start mb-1 p-2 sidebar-item">
                <i class="bi bi-house-fill me-2"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </div>

        {{-- Opciones para Admin y Staff --}}
        @if(in_array($user->role, ['admin', 'staff']))
        <div class="mb-2">
            <h6 class="text-muted small mb-1 sidebar-text">ADMINISTRACIÓN</h6>

            {{-- Gestión de Usuarios --}}
            <div class="mb-1">
                <a href="{{ route('users.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-people-fill me-2"></i>
                    <span class="sidebar-text">Usuarios</span>
                </a>
            </div>

            {{-- Catálogos --}}
            <div class="mb-1">
                <a href="{{ route('catalogs.index') }}" class="btn btn-outline-success w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-bookmarks me-2"></i>
                    <span class="sidebar-text">Catálogos</span>
                </a>
            </div>

            {{-- Gestión de Recursos --}}
            <div class="mb-1">
                <a href="{{ route('resources.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-tools me-2"></i>
                    <span class="sidebar-text">Recursos</span>
                </a>
            </div>

            {{-- Gestión de Préstamos --}}
            <div class="mb-1">
                <a href="{{ route('loans.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-clipboard-check me-2"></i>
                    <span class="sidebar-text">Préstamos</span>
                </a>
            </div>

            {{-- Gestión de Evidencias --}}
            <div class="mb-1">
                <a href="{{ route('loan-evidences.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-camera-fill me-2"></i>
                    <span class="sidebar-text">Evidencias</span>
                </a>
            </div>

            {{-- Gestión de Alertas --}}
            <div class="mb-1">
                <a href="{{ route('alerts.index') }}" class="btn btn-outline-warning w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <span class="sidebar-text">Alertas</span>
                </a>
            </div>

            {{-- Sedes y Programas --}}
            <div class="mb-1">
                <a href="{{ route('campuses.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-building me-2"></i>
                    <span class="sidebar-text">Sedes</span>
                </a>
            </div>

            <div class="mb-1">
                <a href="{{ route('programs.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-book-half me-2"></i>
                    <span class="sidebar-text">Programas</span>
                </a>
            </div>

            {{-- Contactos --}}
            <div class="mb-1">
                <a href="{{ route('contacts.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-person-lines-fill me-2"></i>
                    <span class="sidebar-text">Contactos</span>
                </a>
            </div>
        </div>
        @endif

        {{-- Opciones para Estudiantes y Profesores --}}
        @if(in_array($user->role, ['estudiante', 'profesor']))
        <div class="mb-2">
            <h6 class="text-muted small mb-1 sidebar-text">MIS OPCIONES</h6>

            <div class="mb-1">
                <a href="{{ route('loans.create') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-plus-circle me-2"></i>
                    <span class="sidebar-text">Solicitar Préstamo</span>
                </a>
            </div>

            <div class="mb-1">
                <a href="{{ route('loans.index') }}" class="btn btn-outline-light w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-list-check me-2"></i>
                    <span class="sidebar-text">Mis Préstamos</span>
                </a>
            </div>

            {{-- Para profesores: Inventario --}}
            @if($user->role === 'profesor')
            <div class="mb-1">
                <a href="{{ route('inventory.index') }}" class="btn btn-outline-info w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-box-seam me-2"></i>
                    <span class="sidebar-text">Inventario</span>
                </a>
            </div>
            @endif

            {{-- Reportar Alertas --}}
            <div class="mb-1">
                <a href="{{ route('alerts.create') }}" class="btn btn-outline-warning w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <span class="sidebar-text">Reportar Problema</span>
                </a>
            </div>
        </div>
        @endif

        {{-- Opciones Comunes --}}
        <div class="mb-4">
            <h6 class="text-muted small mb-1 sidebar-text">GENERAL</h6>

            {{-- Perfil --}}
            <div class="mb-1">
                <a href="{{ route('profile.show') }}" class="btn btn-outline-info w-100 text-start p-2 sidebar-item">
                    <i class="bi bi-person-circle me-2"></i>
                    <span class="sidebar-text">Mi Perfil</span>
                </a>
            </div>

            {{-- Cerrar sesión --}}
            <div class="mb-1">
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 text-start p-2 sidebar-item">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span class="sidebar-text">Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

{{-- Overlay para móvil --}}
<div class="sidebar-overlay"></div>

<style>
    #sidebar {
        width: 250px;
        min-height: 100vh;
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .sidebar-overlay.show {
        display: block;
    }

    #sidebar.collapsed {
        width: 60px;
    }

    #sidebar.collapsed .sidebar-text {
        display: none;
    }

    #sidebar.collapsed .sidebar-item {
        text-align: center;
        padding: 0.5rem !important;
    }

    #sidebar.collapsed .sidebar-item i {
        margin-right: 0 !important;
    }

    #sidebar .btn {
        border: none;
        padding: 0.5rem;
        font-size: 0.85rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
    }

    #sidebar .btn:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateX(2px);
    }

    #sidebar .sidebar-header h6 {
        font-size: 0.9rem;
    }

    #sidebar h6.text-muted {
        font-size: 0.7rem;
        margin-top: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        #sidebar {
            position: fixed;
            left: -250px;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        #sidebar.mobile-open {
            left: 0;
        }

        main.col {
            margin-left: 0 !important;
        }
    }

    @media (min-width: 992px) {
        #sidebar.collapsed+main {
            margin-left: 60px;
        }
    }

    /* Badge para contadores */
    .sidebar-badge {
        font-size: 0.6rem;
        padding: 0.2rem 0.4rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const sidebarOverlay = document.querySelector('.sidebar-overlay');

        function toggleSidebar() {
            if (window.innerWidth >= 992) {
                sidebar.classList.toggle('collapsed');
            } else {
                sidebar.classList.toggle('mobile-open');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.toggle('show');
                }
            }
        }

        // Event listeners
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (mobileSidebarToggle) {
            mobileSidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('show');
            });
        }

        // Auto-colapsar en móvil por defecto
        if (window.innerWidth < 992) {
            sidebar.classList.remove('collapsed');
        }

        // Ajustar al cambiar tamaño de ventana
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('mobile-open');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('show');
                }
            } else {
                sidebar.classList.remove('collapsed');
            }
        });

        // Resaltar elemento activo
        const currentPath = window.location.pathname;
        const sidebarItems = document.querySelectorAll('.sidebar-item');

        sidebarItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentPath.startsWith(href.replace(route('home'), ''))) {
                item.classList.add('active');
                item.classList.remove('btn-outline-light', 'btn-outline-info', 'btn-outline-warning', 'btn-outline-success', 'btn-outline-danger');
                item.classList.add('btn-primary');
            }
        });
    });
</script>