<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Bohemian's</title>

    <!-- Bootstrap 5.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --boh-primary: #0f172a;       /* Azul Noche / Carbón */
            --boh-dark-blue: #020617;     /* Negro Profundo */
            --boh-subnav: #1e293b;        /* Gris Pizarra Oscuro */
            --boh-yellow: #f59e0b;        /* Ámbar / Dorado Cálido */
            --boh-yellow-hover: #d97706;  /* Dorado Hover */
        }

        body {
            background-color: var(--boh-dark-blue);
            color: #ffffff;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #ffffff;
            color: #1e293b;
            border-radius: 1.25rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.5);
            max-width: 440px;
            width: 100%;
        }

        .btn-boh-yellow {
            background-color: var(--boh-yellow);
            color: #020617;
            font-weight: 700;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .btn-boh-yellow:hover {
            background-color: var(--boh-yellow-hover);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        }

        .text-boh-yellow { color: var(--boh-yellow) !important; }
        .text-boh-primary { color: var(--boh-primary) !important; }

        .form-control:focus {
            border-color: var(--boh-yellow);
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
        }
    </style>
</head>
<body>

    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                
                <!-- Logo -->
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-black fs-2 tracking-wider d-block">
                        BOHEMIAN'S
                    </a>
                    <p class="text-muted small mb-0">Inicia sesión para gestionar tus compras o catálogo</p>
                </div>

                <!-- Tarjeta de Login -->
                <div class="card login-card p-4 p-md-5 border-0 mx-auto">
                    
                    <h4 class="fw-bold text-boh-primary mb-4 text-center">Bienvenido de nuevo</h4>

                    @if (session('status'))
                        <div class="alert alert-success small mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small text-muted">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" placeholder="ejemplo@correo.com" required autofocus autocomplete="username">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-semibold small text-muted mb-0">Contraseña</label>
                                @if (Route::has('password.request'))
                                    <a class="text-boh-primary small text-decoration-none fw-semibold" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-lock"></i></span>
                                <input type="password" id="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="••••••••" required autocomplete="current-password">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Recordar Sesión -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-input-label small text-muted" for="remember_me">
                                Recordarme en este dispositivo
                            </label>
                        </div>

                        <!-- Botón Ingresar -->
                        <button type="submit" class="btn btn-boh-yellow w-100 py-3 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                            <i class="bi bi-box-arrow-in-right fs-5"></i> Iniciar Sesión
                        </button>
                    </form>

                    <hr class="my-4 text-muted">

                    <!-- Enlace a Registro -->
                    <div class="text-center">
                        <span class="small text-muted">¿Aún no tienes una cuenta?</span>
                        <a href="{{ route('register') }}" class="text-boh-primary fw-bold small text-decoration-none ms-1">Regístrate aquí</a>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="text-white-50 text-decoration-none small">
                        <i class="bi bi-arrow-left me-1"></i> Volver a la tienda principal
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>