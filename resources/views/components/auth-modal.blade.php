<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">

                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-login-tab" data-bs-toggle="tab" data-bs-target="#tab-login" type="button" role="tab">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-reset-tab" data-bs-toggle="tab" data-bs-target="#tab-reset" type="button" role="tab">Reset</button>
                    </li>
                </ul>

                <div class="tab-content pt-3">
                    <img
                        src="{{ asset('images/global/imagotipo/IMAGOTIPO HORIZONTAL NEGRO.png') }}"
                        alt="Universidad de Cundinamarca"
                        class="img-fluid d-block mx-auto"
                        style="max-height: 80px; height: auto; width: auto;"
                        loading="lazy">

                    {{-- LOGIN --}}
                    <div class="tab-pane fade show active" id="tab-login" role="tabpanel" aria-labelledby="tab-login-tab">
                        <form method="POST" action="{{ url('/login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="login-email" class="form-label">Email</label>
                                <input id="login-email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="login-password" class="form-label">Password</label>
                                <input id="login-password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>

                    {{-- RESET (envío de enlace) --}}
                    <div class="tab-pane fade" id="tab-reset" role="tabpanel" aria-labelledby="tab-reset-tab">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="reset-email" class="form-label">Email</label>
                                <input id="reset-email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Enviar enlace de reseteo</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>