<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Cuenta - Bohemian's</title>

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
            background-color: #f8fafc;
            color: #0f172a;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .bg-boh-primary { background-color: var(--boh-primary) !important; }
        .bg-boh-dark { background-color: var(--boh-dark-blue) !important; }
        .bg-boh-subnav { background-color: var(--boh-subnav) !important; }
        
        .text-boh-yellow { color: var(--boh-yellow) !important; }
        
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
        }

        .stat-card {
            border: none;
            border-radius: 1rem;
            transition: transform 0.2s ease;
        }
        .stat-card:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

    @if(Auth::user()->isAdmin())
        <!-- ========================================== -->
        <!-- PANEL DE CONTROL: ADMINISTRADOR            -->
        <!-- ========================================== -->
        
        <nav class="navbar navbar-expand-lg bg-boh-dark navbar-dark py-3 shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-black fs-3 tracking-wider" href="{{ route('dashboard') }}">
                    BOHEMIAN'S <span class="badge bg-warning text-dark fs-6 ms-2">Panel Administrador</span>
                </a>
                
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm rounded-pill fw-bold px-3" target="_blank">
                        <i class="bi bi-shop me-1"></i> Ver Tienda
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold">
                            <i class="bi bi-box-arrow-right me-1"></i> Salir
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container my-5">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Hola, {{ Auth::user()->name }} 👋</h3>
                <p class="text-muted">Resumen ejecutivo y control de inventario de Bohemian's.</p>
            </div>

            <!-- Métricas Admin -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card stat-card bg-boh-primary text-white p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 text-uppercase fw-bold small mb-1">Total Productos</h6>
                                <h2 class="fw-black mb-0">{{ $totalProducts ?? 0 }}</h2>
                            </div>
                            <i class="bi bi-box-seam fs-1 text-white-50"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card bg-boh-subnav text-white p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-boh-yellow text-uppercase fw-bold small mb-1">Categorías</h6>
                                <h2 class="fw-black mb-0">{{ $totalCategories ?? 0 }}</h2>
                            </div>
                            <i class="bi bi-tags fs-1 text-boh-yellow"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card bg-warning text-dark p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-dark-50 text-uppercase fw-bold small mb-1">Stock Bajo (&le; 5)</h6>
                                <h2 class="fw-black mb-0">{{ isset($lowStockProducts) ? $lowStockProducts->count() : 0 }}</h2>
                            </div>
                            <i class="bi bi-exclamation-triangle fs-1 text-dark-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Admin -->
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0"><i class="bi bi-boxes text-warning me-2"></i>Gestión de Catálogo</h5>
                            @if(Route::has('productos.index'))
                                <a href="{{ route('productos.index') }}" class="btn btn-dark btn-sm rounded-pill px-3">Ver Productos</a>
                            @endif
                        </div>
                        <p class="text-muted small">Administra los precios, edita información o agrega nuevos artículos al catálogo general.</p>
                        @if(Route::has('productos.create'))
                            <div>
                                <a href="{{ route('productos.create') }}" class="btn btn-boh-yellow btn-sm fw-bold rounded-3 px-3">
                                    <i class="bi bi-plus-lg"></i> Crear Nuevo Producto
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h5 class="fw-bold mb-3"><i class="bi bi-bell text-danger me-2"></i>Alertas de Inventario</h5>
                        @if(isset($lowStockProducts) && $lowStockProducts->count() > 0)
                            <ul class="list-group list-group-flush small">
                                @foreach($lowStockProducts->take(5) as $prod)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span class="text-truncate" style="max-width: 180px;">{{ $prod->name }}</span>
                                        <span class="badge bg-danger text-white rounded-pill">{{ $prod->stock }} un.</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted small mb-0"><i class="bi bi-check-circle text-success me-1"></i> Inventario en buen estado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- ========================================== -->
        <!-- MI CUENTA / DASHBOARD: CLIENTE             -->
        <!-- ========================================== -->

        <!-- Top Navigation Bar -->
        <nav class="navbar navbar-expand-lg bg-boh-dark navbar-dark sticky-top py-3">
            <div class="container">
                <a class="navbar-brand fw-black fs-3 tracking-wider text-white" href="{{ route('home') }}">
                    BOHEMIAN'S
                </a>

                <div class="d-flex align-items-center gap-3 ms-auto">
                    <!-- Botón Ir a Comprar -->
                    <a href="{{ route('home') }}" class="btn btn-outline-light rounded-pill px-3 btn-sm fw-bold">
                        <i class="bi bi-shop me-1"></i> Ir a la Tienda
                    </a>

                    <!-- Carrito -->
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light rounded-pill px-3 btn-sm position-relative">
                        <i class="bi bi-cart3 me-1"></i> Carrito
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark fw-bold">
                                {{ array_sum(array_column(session('cart'), 'quantity')) }}
                            </span>
                        @endif
                    </a>

                    <!-- Menú de Usuario -->
                    <div class="dropdown">
                        <button class="btn btn-boh-yellow dropdown-toggle rounded-pill px-3 btn-sm fw-bold" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            @if(Route::has('profile.edit'))
                                <li><a class="dropdown-item fw-semibold" href="{{ route('profile.edit') }}"><i class="bi bi-gear me-2"></i> Ajustes de Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold">
                                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Banner Principal de Bienvenida al Cliente -->
        <div class="container my-4">
            <div class="p-4 p-md-5 rounded-4 bg-boh-primary text-white shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-boh-yellow text-dark rounded-circle d-flex align-items-center justify-content-center fw-black fs-2" style="width: 64px; height: 64px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="fw-black text-boh-yellow mb-1">¡Hola, {{ Auth::user()->name }}!</h3>
                        <p class="text-white-50 mb-0"><i class="bi bi-envelope me-1"></i> {{ Auth::user()->email }} | Miembro desde {{ Auth::user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-boh-yellow rounded-pill fw-bold px-4 py-2">
                        <i class="bi bi-bag-plus me-1"></i> Realizar Nueva Compra
                    </a>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="row g-4">
                
                <!-- Columna Izquierda: Mis Pedidos Recientes -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0"><i class="bi bi-receipt text-warning me-2"></i>Mis Pedidos Recientes</h5>
                            <span class="badge bg-light text-dark border rounded-pill">{{ count($orders ?? []) }} Pedidos registrados</span>
                        </div>

                        @if(isset($orders) && count($orders) > 0)
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light small">
                                        <tr>
                                            <th>Orden #</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Total</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td class="fw-bold">#{{ $order->id }}</td>
                                                <td class="text-muted small">{{ $order->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success rounded-pill fw-bold">
                                                        <i class="bi bi-check-circle me-1"></i> Procesado
                                                    </span>
                                                </td>
                                                <td class="fw-bold text-boh-primary">Q{{ number_format($order->total, 2) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-dark rounded-pill">Detalles</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <!-- Estado sin pedidos -->
                            <div class="text-center py-5 bg-light rounded-4">
                                <i class="bi bi-bag-x fs-1 text-muted d-block mb-2"></i>
                                <h6 class="fw-bold text-dark">Aún no has realizado ninguna compra</h6>
                                <p class="text-muted small mb-3">Tus pedidos y compras procesadas aparecerán organizados aquí.</p>
                                <a href="{{ route('home') }}" class="btn btn-boh-yellow btn-sm rounded-pill px-4 fw-bold">
                                    Explorar Productos
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Columna Derecha: Tarjeta de Datos de Cuenta y Soporte -->
                <div class="col-lg-4">
                    
                    <!-- Resumen del Perfil -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-person-vcard text-primary me-2"></i>Datos de Mi Cuenta</h5>
                        
                        <div class="mb-3">
                            <label class="text-muted small d-block">Nombre Completo</label>
                            <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small d-block">Correo Registrado</label>
                            <span class="fw-bold text-dark">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small d-block">Estado de la Cuenta</label>
                            <span class="badge bg-success rounded-pill"><i class="bi bi-shield-check me-1"></i> Cuenta Activa</span>
                        </div>

                        @if(Route::has('profile.edit'))
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold mt-2">
                                <i class="bi bi-pencil me-1"></i> Editar Información de Perfil
                            </a>
                        @endif
                    </div>

                    <!-- Soporte y Ayuda -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-boh-subnav text-white">
                        <h6 class="fw-bold text-boh-yellow mb-2"><i class="bi bi-headset me-2"></i>¿Necesitas Ayuda con una Compra?</h6>
                        <p class="small text-white-50 mb-3">Nuestro equipo atiende consultas sobre envíos a todo el país y estados de orden.</p>
                        <a href="https://wa.me/" target="_blank" class="btn btn-sm btn-success rounded-pill fw-bold w-100">
                            <i class="bi bi-whatsapp me-1"></i> Contactar por WhatsApp
                        </a>
                    </div>

                </div>

            </div>
        </div>

    @endif

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>