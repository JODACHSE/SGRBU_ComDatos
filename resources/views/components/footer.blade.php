<footer class="bg-dark text-light border-top py-3">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-center text-center">
        <a class="mb-2 mb-md-0 text-center" href="https://www.ucundinamarca.edu.co/index.php/programas/pregrado/facultad-de-ingenieria/ingenieria-de-sistemas-y-computacion" target="_blank" rel="noopener">
            <picture>
                <source srcset="{{ asset('images/global/imagotipo/IMAGOTIPO HORIZONTAL BLANCO.png') }}" media="(prefers-color-scheme: dark)">
                <img id="logo-u-cundi" src="{{ asset('images/global/imagotipo/IMAGOTIPO HORIZONTAL BLANCO.png') }}" alt="Universidad de Cundinamarca" height="40">
            </picture>
        </a>

        <!-- Separador vertical responsivo (compatible BS4/BS5) -->
        <span class="d-none d-md-inline-block mx-md-4 mx-lg-5" aria-hidden="true" style="width:1px;height:28px;background-color:rgba(255,255,255,.25);"></span>

        <span class="text-center small">
            Proyecto desarrollado por
            <img src="{{ asset('images/global/WololoIcon.png') }}" alt="Wololo" height="18" class="align-text-bottom">
            <span class="brand-footer font-weight-bold">Wololo</span>
            ·
            <a class="text-decoration-none text-white" href="https://github.com/JODACHSE/sgrbu.git" target="_blank" rel="noopener">Repositorio</a>
            ·
            <span>&copy; {{ now()->year }}</span>
        </span>
    </div>
</footer>