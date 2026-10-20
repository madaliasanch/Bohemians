<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - Bohemian's</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --boh-primary: #0f172a;       /* Azul Noche / Carbón */
            --boh-dark-blue: #020617;     /* Negro Profundo Header/Footer */
            --boh-subnav: #1e293b;        /* Gris Pizarra Oscuro (Barra Categorías) */
            --boh-yellow: #f59e0b;        /* Ámbar / Dorado Cálido */
            --boh-yellow-hover: #d97706;  /* Dorado Hover */
        }

        body {
            background-color: #020617; /* Fondo oscuro exterior de la tienda */
            color: #2b2b2b;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        /* Clases de Identidad */
        .bg-boh-dark { background-color: var(--boh-dark-blue) !important; }
        .bg-boh-primary { background-color: var(--boh-primary) !important; }
        .bg-boh-subnav { background-color: var(--boh-subnav) !important; }
        .text-boh-primary { color: var(--boh-primary) !important; }
        .text-boh-yellow { color: var(--boh-yellow) !important; }

        /* Botón Dorado */
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

        /* Nav Categorías */
        .subnav-link {
            color: #cbd5e1;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            white-space: nowrap;
        }
        .subnav-link:hover {
            color: var(--boh-yellow);
        }

        /* Contenedor de Imagen con tamaño fijo */
        .product-image-box {
            background-color: #ffffff;
            border-radius: 0.75rem;
            height: 380px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
        }
        .product-image-box img {
            max-height: 340px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- 1. HEADER COMPLETO (ARRIBA) -->
    <header class="bg-boh-dark text-white border-bottom border-secondary-subtle">
        <!-- Cinta Superior Informativa -->
        <div class="bg-boh-subnav py-1 text-center small text-light fs-7">
            🚀 Envíos a toda Guatemala | Pago contra entrega disponible | Compras 100% Seguras
        </div>

        <!-- Barra Principal: Logo + Buscador + Usuario/Carrito -->
        <div class="container py-3">
            <div class="row align-items-center g-3">
                
                <!-- Logo -->
                <div class="col-12 col-md-3 text-center text-md-start">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-black fs-3 tracking-wider">
                        BOHEMIAN'S
                    </a>
                </div>

                <!-- Buscador -->
                <div class="col-12 col-md-6">
                    <form action="{{ url('/') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control rounded-start-pill px-3" placeholder="Buscar productos, marcas y más...">
                            <button type="submit" class="btn btn-boh-yellow rounded-end-pill px-4">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Usuario y Carrito -->
                <div class="col-12 col-md-3 text-center text-md-end d-flex align-items-center justify-content-center justify-content-md-end gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-white text-decoration-none fw-semibold small">Ingresar</a>
                    @else
                        <span class="text-white small fw-bold">{{ Auth::user()->name }}</span>
                    @endguest

                    <a href="{{ route('cart.index') }}" class="btn btn-boh-yellow btn-sm rounded-pill d-inline-flex align-items-center gap-2 px-3">
                        <i class="bi bi-cart3 fs-6"></i>
                        <span>Carrito</span>
                        <span class="badge rounded-circle bg-dark text-white">
                            {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                        </span>
                    </a>
                </div>

            </div>
        </div>

<!-- Subnav Dinámico de Categorías -->
<div class="bg-boh-subnav overflow-x-auto">
    <div class="container d-flex align-items-center py-1">
        <a href="{{ route('home') }}" class="subnav-link text-boh-yellow fw-bold">
            <i class="bi bi-grid-fill me-1"></i> Todos los Productos
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat->id]) }}" class="subnav-link">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
</div>

<!-- Breadcrumb Dinámico -->
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white p-2 rounded-3 shadow-sm small mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-boh-primary text-decoration-none fw-bold">Inicio</a>
            </li>
            @if(isset($product->category))
                <li class="breadcrumb-item">
                    <a href="{{ route('home', ['category' => $product->category->id]) }}" class="text-boh-primary text-decoration-none fw-bold">
                        {{ $product->category->name }}
                    </a>
                </li>
            @endif
            <li class="breadcrumb-item active text-muted" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
</div>
    <!-- 3. CONTENEDOR PRINCIPAL BLANCO -->
    <main class="container my-4 flex-grow-1">
        <div class="card border-0 shadow-lg rounded-4 bg-white p-4">
            
            <!-- SECCIÓN SUPERIOR: IMAGEN Y DATOS DEL PRODUCTO (2 COLUMNAS) -->
            <div class="row g-4 align-items-start">
                
                <!-- Columna Izquierda: Imagen (6/12) -->
                <div class="col-lg-6">
                    <div class="product-image-box p-3">
                        @if(!empty($product->image_url))
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
                        @else
                            <div class="text-center text-muted">
                                <i class="bi bi-image fs-1 d-block mb-2"></i>
                                <span>Sin Imagen Disponibles</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Columna Derecha: Información y Compra (6/12) -->
                <div class="col-lg-6">
                    <div class="ps-lg-2">
                        
                        <!-- Categoría / Stock -->
                        <div class="d-flex align-items-center gap-2 mb-2">
                            @if(isset($product->category))
                                <span class="badge bg-light text-boh-primary border px-3 py-1 rounded-pill fw-bold">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                            
@if($product->stock > 0)
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill">
            <i class="bi bi-check-circle-fill me-1"></i> En Existencia ({{ $product->stock }} disponibles)
        </span>
    @else
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill">
            <i class="bi bi-x-circle-fill me-1"></i> Agotado
        </span>
    @endif
</div>
                        <!-- Título del Producto -->
                        <h2 class="fw-bold text-boh-primary mb-2 fs-3">{{ $product->name }}</h2>
                        
                        <!-- Valoración Fake/Estrellas -->
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="text-warning small fs-6">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </span>
                            <small class="text-muted fw-semibold">4.8 (24 opiniones)</small>
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <small class="text-danger fw-bold d-block text-uppercase tracking-wider">Oferta Exclusiva</small>
                            <span class="fs-1 fw-black text-danger font-monospace">
                                Q {{ number_format($product->price, 2) }}
                            </span>
                        </div>

                        <!-- Descripción Breve -->
                        <div class="p-3 bg-light rounded-3 mb-4 border">
                            <h6 class="fw-bold text-boh-primary small uppercase mb-1"><i class="bi bi-file-text me-1"></i> Descripción del producto</h6>
                            <p class="text-muted small mb-0">{{ $product->description ?? 'Producto importado disponible con envío a todo el país.' }}</p>
                        </div>

                        <!-- Formulario de Agregar al Carrito -->
                        @if(($product->stock ?? 0) > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <label for="quantity" class="form-label mb-0 fw-bold text-boh-primary small">Cantidad:</label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock ?? 99 }}" class="form-control text-center fw-bold rounded-3" style="width: 90px; height: 42px;">
                                </div>

                                <button type="submit" class="btn btn-boh-yellow btn-lg w-100 rounded-3 py-3 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                    <i class="bi bi-cart-plus-fill fs-5"></i> Comprar Ahora
                                </button>
                            </form>
                        @endif

                    </div>
                </div> <!-- ¡AQUÍ SE CIERRA CORRECTAMENTE LA COLUMNA DERECHA! -->

            </div> <!-- ¡AQUÍ SE CIERRA LA ROW DE 2 COLUMNAS! -->

            <!-- ======================================================== -->
            <!-- DESDE AQUÍ ABAJO LAS SECCIONES OCUPAN EL 100% DEL ANCHO  -->
            <!-- ======================================================== -->

            <hr class="my-5">

            <!-- SECCIÓN: ESPECIFICACIONES -->
            <div class="mb-5">
                <h5 class="fw-bold text-boh-primary mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-sliders text-boh-yellow fs-4"></i> Especificaciones
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-sm mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-light text-muted w-25">Categoría</th>
                                <td>{{ $product->category->name ?? 'General' }}</td>
                                <th class="bg-light text-muted w-25">SKU de Identificación</th>
                                <td>BOH-000{{ $product->id }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted">Disponibilidad</th>
                                <td>{{ $product->stock }} unidades</td>
                                <th class="bg-light text-muted">Garantía</th>
                                <td>Garantía por defectos de fábrica</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr class="my-5">

            <!-- SECCIÓN: OPINIONES DE CLIENTES -->
            <div>
                <h5 class="fw-bold text-boh-primary mb-3 d-flex align-items-center gap-2">
                    <i class="bi bi-star-fill text-boh-yellow fs-4"></i> Opiniones de Clientes
                </h5>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                    <span class="fs-1 fw-black text-boh-primary">4.8</span>
                    <div>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <small class="text-muted">Basado en opiniones verificadas de compradores.</small>
                    </div>
                </div>
            </div>

        </div> <!-- FIN DE TARJETA BLANCA -->
    </main>

    <!-- 4. FOOTER (FUERA DEL CONTENEDOR, AL FINAL DE LA PÁGINA) -->
    <footer class="bg-boh-dark text-white pt-5 pb-3 mt-auto border-top border-secondary-subtle">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="fw-bold text-boh-yellow">BOHEMIAN'S</h5>
                    <p class="text-muted small">La tienda en línea número uno de productos de tecnología, hogar, gadgets y mucho más en Guatemala.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Atención al Cliente</h6>
                    <ul class="list-unstyled text-muted small space-y-2">
                        <li><i class="bi bi-whatsapp me-2 text-success"></i> Soporte por WhatsApp</li>
                        <li><i class="bi bi-truck me-2 text-boh-yellow"></i> Envíos a los 22 departamentos</li>
                        <li><i class="bi bi-cash-coin me-2 text-boh-yellow"></i> Pago Contra Entrega</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Garantía y Seguridad</h6>
                    <p class="text-muted small mb-0">Tus compras están totalmente protegidas. Recibe tus productos en la puerta de tu casa.</p>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-muted small">
                © {{ date('Y') }} BOHEMIAN'S. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>