<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Perfil - Bohemian's</title>

    <!-- Bootstrap 5.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --boh-primary: #0f172a;
            --boh-dark-blue: #020617;
            --boh-yellow: #f59e0b;
            --boh-yellow-hover: #d97706;
        }

        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .bg-boh-dark { background-color: var(--boh-dark-blue) !important; }
        .text-boh-yellow { color: var(--boh-yellow) !important; }

        .btn-boh-yellow {
            background-color: var(--boh-yellow);
            color: #020617;
            font-weight: 700;
            border: none;
        }
        .btn-boh-yellow:hover {
            background-color: var(--boh-yellow-hover);
            color: #ffffff;
        }

        .card-custom {
            border: none;
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .cart-pill-btn {
            background-color: var(--boh-yellow);
            color: #020617;
            font-weight: 700;
            padding: 0.4rem 0.9rem;
            border-radius: 50rem;
            transition: all 0.2s ease-in-out;
        }
        .cart-pill-btn:hover {
            background-color: var(--boh-yellow-hover);
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <nav class="navbar navbar-expand-lg bg-boh-dark navbar-dark py-3 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-black fs-3 tracking-wider text-white" href="{{ route('home') }}">
                BOHEMIAN'S
            </a>

            <div class="d-flex align-items-center gap-3 ms-auto">
                <!-- Menú Usuario -->
                <div class="dropdown">
                    <a href="#" class="text-white text-decoration-none fw-semibold small dropdown-toggle d-inline-flex align-items-center gap-1" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-5 text-warning"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userMenuDropdown">
                        <li>
                            <a class="dropdown-item fw-semibold small" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2 text-warning"></i> {{ Auth::user()->isAdmin() ? 'Panel Admin' : 'Mi Cuenta' }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item fw-semibold small" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear me-2 text-muted"></i> Ajustes de Perfil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-bold small">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Carrito -->
                <a href="{{ route('cart.index') }}" class="cart-pill-btn d-inline-flex align-items-center gap-2 shadow-sm text-decoration-none">
                    <i class="bi bi-cart3 fs-5"></i>
                    <span class="d-none d-sm-inline">Carrito</span>
                    <span class="badge rounded-circle bg-dark text-white px-2 py-1" style="font-size: 0.72rem;">
                        {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Subheader Banner -->
    <div class="bg-white border-bottom py-4 mb-4">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="fw-bold mb-1"><i class="bi bi-person-gear text-warning me-2"></i>Ajustes de la Cuenta</h3>
                    <p class="text-muted small mb-0">Gestiona tu información personal, correo electrónico y credenciales de acceso.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3 fw-bold">
                    <i class="bi bi-arrow-left me-1"></i> Ir al Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="container mb-5" style="max-width: 900px;">

        <!-- Alert de éxito para actualización de perfil -->
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> Tu información de perfil ha sido actualizada correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Alert de éxito para cambio de contraseña -->
        @if (session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="bi bi-shield-check me-2"></i> Tu contraseña ha sido actualizada con éxito.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- TARJETA 1: Información de Perfil -->
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-warning-subtle text-warning p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-person-vcard fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Información del Perfil</h5>
                    <small class="text-muted">Actualiza el nombre de tu cuenta y tu dirección de correo electrónico.</small>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small text-muted">Nombre Completo</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold small text-muted">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-boh-yellow rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

        <!-- TARJETA 2: Cambiar Contraseña -->
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-primary-subtle text-primary p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-shield-lock fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Actualizar Contraseña</h5>
                    <small class="text-muted">Asegúrate de utilizar una contraseña larga y aleatoria para mantener tu cuenta segura.</small>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <!-- Contraseña Actual -->
                <div class="mb-3">
                    <label for="update_password_current_password" class="form-label fw-semibold small text-muted">Contraseña Actual</label>
                    <input type="password" id="update_password_current_password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nueva Contraseña -->
                <div class="mb-3">
                    <label for="update_password_password" class="form-label fw-semibold small text-muted">Nueva Contraseña</label>
                    <input type="password" id="update_password_password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmar Nueva Contraseña -->
                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label fw-semibold small text-muted">Confirmar Nueva Contraseña</label>
                    <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-boh-yellow rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-key me-1"></i> Actualizar Contraseña
                    </button>
                </div>
            </form>
        </div>

        <!-- TARJETA 3: Eliminar Cuenta (Zona de Peligro) -->
        <div class="card card-custom p-4 border border-danger-subtle">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-danger-subtle text-danger p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-danger">Eliminar Cuenta</h5>
                    <small class="text-muted">Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán permanentemente.</small>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="text-muted small">Esta acción no se puede deshacer.</span>
                <!-- Botón que activa el Modal de Confirmación -->
                <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                    <i class="bi bi-trash me-1"></i> Eliminar Cuenta
                </button>
            </div>
        </div>

    </div>

    <!-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN DE CUENTA -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-danger" id="confirmUserDeletionModalLabel">
                            <i class="bi bi-exclamation-octagon-fill me-2"></i>¿Seguro que deseas eliminar tu cuenta?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-3">
                        <p class="text-muted small">
                            Una vez que se elimine tu cuenta, todos los datos vinculados se perderán permanentemente. Ingresa tu contraseña para confirmar la eliminación.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small text-muted">Contraseña Actual</label>
                            <input type="password" id="password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Ingresa tu contraseña" required>
                            @error('password', 'userDeletion')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">
                            Eliminar Mi Cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Abrir modal automáticamente si hubo errores al intentar eliminar la cuenta -->
    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var deleteModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                deleteModal.show();
            });
        </script>
    @endif

</body>
</html>