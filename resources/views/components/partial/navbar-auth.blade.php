<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
            <img src="{{ asset('images/global/WololoIcon.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            {{ config('app.name', 'Laravel') }}
        </a>

        {{-- Mobile Sidebar Toggle --}}
        <button class="btn btn-outline-light d-lg-none" id="mobileSidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>
    </div>
</nav>