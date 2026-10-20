<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOHEMIAN'S - Tienda en Línea Guatemala</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
:root {
    --boh-primary: #0f172a;       /* Azul Noche / Carbón */
    --boh-dark-blue: #020617;     /* Negro Profundo (Header Superior) */
    --boh-subnav: #1e293b;        /* Gris Pizarra Oscuro (Menú Categorías) */
    --boh-yellow: #f59e0b;        /* Ámbar / Dorado Cálido (Botones) */
    --boh-yellow-hover: #d97706;  /* Dorado Hover */
}
        body {
            background-color: #f4f6f9;
            color: #2b2b2b;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        /* --- CABECERA BOHEMIAN'S --- */
        .top-announcement {
            background-color: var(--boh-dark-blue);
            color: #ffffff;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .main-header {
            background-color: var(--boh-primary);
        }

        .brand-logo {
            font-size: 1.85rem;
            font-weight: 900;
            letter-spacing: 0.5px;
            color: #ffffff;
            text-decoration: none;
        }

        .search-btn-yellow {
            background-color: var(--boh-yellow);
            color: #111;
            font-weight: 700;
            border: none;
            border-radius: 50px;
            padding: 6px 20px;
            transition: all 0.2s ease;
        }

        .search-btn-yellow:hover {
            background-color: var(--boh-yellow-hover);
            color: #000;
        }

        .cart-pill-btn {
            background-color: var(--boh-yellow);
            color: #111;
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 18px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .cart-pill-btn:hover {
            background-color: var(--boh-yellow-hover);
            color: #000;
        }

        .category-subnav {
            background-color: var(--boh-subnav);
        }

        .category-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
            white-space: nowrap;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .category-link:hover, .category-link.active {
            background-color: rgba(255, 255, 255, 0.22);
            color: #ffffff;
            font-weight: 700;
        }

        /* --- HERO BANNER CARRUSEL --- */
        .hero-banner {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .hero-slide {
            background: linear-gradient(135deg, #1e2238 0%, #4355E3 100%);
            color: white;
            padding: 48px 32px;
            min-height: 320px;
            display: flex;
            align-items: center;
        }

        /* --- CATEGORÍAS DESTACADAS EN BLOQUES --- */
        .category-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px;
            text-align: center;
            text-decoration: none;
            color: #2b2b2b;
            transition: all 0.25s ease;
            display: block;
        }

        .category-card:hover, .category-card.active {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.06);
            border-color: var(--boh-primary);
            color: var(--boh-primary);
        }

        .category-icon-wrapper {
            width: 50px;
            height: 50px;
            background: #eef2ff;
            color: var(--boh-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px auto;
            font-size: 1.4rem;
        }

        /* --- OFERTAS RELÁMPAGO / FLASH SALES --- */
        .flash-sale-box {
            background: linear-gradient(90deg, #1e1b4b 0%, #312e81 100%);
            border-radius: 18px;
            color: white;
            padding: 24px;
        }

        .timer-badge {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 700;
            font-family: monospace;
            font-size: 1rem;
        }

        /* --- TARJETAS DE PRODUCTOS --- */
        .product-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .product-card-img-wrapper {
            height: 220px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .product-card-img-wrapper img {
            max-height: 180px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-card-img-wrapper img {
            transform: scale(1.08);
        }

        .badge-discount {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #dc2626;
            color: white;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 50px;
            z-index: 2;
        }

        .btn-quick-view {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(15, 23, 42, 0.85);
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
            opacity: 0;
            white-space: nowrap;
        }

        .product-card:hover .btn-quick-view {
            bottom: 12px;
            opacity: 1;
        }

        .product-card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .product-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            text-decoration: none;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.7em;
        }

        .product-title:hover {
            color: var(--boh-primary);
        }

        .price-current {
            font-size: 1.35rem;
            font-weight: 800;
            color: #dc2626;
        }

        .price-old {
            font-size: 0.88rem;
            text-decoration: line-through;
            color: #94a3b8;
        }

        .btn-add-cart {
            background-color: var(--boh-yellow);
            color: #111;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            padding: 10px 18px;
            width: 100%;
            transition: all 0.2s ease;
        }

        .btn-add-cart:hover {
            background-color: var(--boh-yellow-hover);
            transform: scale(1.02);
        }

        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hidden {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body>

    @php
        // Verificar si el usuario está filtrando por categoría o buscando
        $isFiltered = request()->filled('category') || request()->filled('search');
        $categoriesList = $categories ?? \App\Models\Category::all();
        
        // Determinar la categoría activa si aplica
        $activeCategory = request()->filled('category') 
            ? $categoriesList->firstWhere('id', request('category')) 
            : null;
    @endphp

    <!-- 1. BARRA SUPERIOR DE ANUNCIOS -->
    <div class="top-announcement text-center py-2">
        🚀 Envíos a toda Guatemala | Pago contra entrega disponible | Compras 100% Seguras
    </div>

    <!-- 2. CABECERA PRINCIPAL BOHEMIAN'S -->
    <header class="main-header py-3">
        <div class="container">
            <div class="row align-items-center g-3">
                
                <!-- Logo -->
                <div class="col-6 col-md-3">
                    <a href="{{ url('/') }}" class="brand-logo">
                        BOHEMIAN'S
                    </a>
                </div>

                <!-- Barra de Búsqueda -->
                <div class="col-12 col-md-6 order-3 order-md-2">
                    <form action="{{ url('/') }}" method="GET" class="m-0">
                        <div class="input-group bg-white rounded-pill p-1 shadow-sm">
                            <input type="text" name="search" class="form-control border-0 rounded-pill px-3 shadow-none" placeholder="Buscar productos, marcas y más..." value="{{ request('search') }}">
                            <button class="btn search-btn-yellow d-flex align-items-center gap-1" type="submit">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </form>
                </div>
<!-- Usuario y Carrito -->
<div class="col-6 col-md-3 order-2 order-md-3 text-end d-flex align-items-center justify-content-end gap-3">
    
    @auth
        <!-- Menú Desplegable para Usuario Logueado -->
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
    @else
        <!-- Enlace a Login cuando es Visitante -->
        <a href="{{ route('login') }}" class="text-white text-decoration-none fw-semibold small">
            Ingresar
        </a>
    @endauth

    <!-- Enlace al Carrito -->
    <a href="{{ route('cart.index') }}" class="cart-pill-btn d-inline-flex align-items-center gap-2 shadow-sm text-decoration-none">
        <i class="bi bi-cart3 fs-5"></i>
        <span>Carrito</span>
        <span class="badge rounded-circle bg-dark text-white px-2 py-1" style="font-size: 0.72rem;">
            {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
        </span>
    </a>

</div>

            </div>
        </div>
    </header>

    <!-- 3. MENÚ SECUNDARIO DE CATEGORÍAS (MAPEADO DINÁMICO) -->
    <nav class="category-subnav py-2 border-top border-white-10">
        <div class="container">
            <div class="d-flex align-items-center gap-1 overflow-auto text-nowrap pb-1 scrollbar-hidden">
                <a href="{{ url('/') }}" class="btn btn-sm btn-dark rounded-pill px-3 fw-bold me-2 text-warning d-flex align-items-center gap-1 {{ !$isFiltered ? 'shadow' : '' }}" style="background-color: #232a52; border: none;">
                    🔥 Todos los Productos
                </a>

                @foreach($categoriesList as $cat)
                    <a href="{{ url('/?category=' . $cat->id) }}" class="category-link {{ request('category') == $cat->id ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    <!-- MODO VISTA COMPLETA (INICIO) vs MODO FILTRADO -->
    @if(!$isFiltered)
        
        <!-- 4. BANNER HERO DINÁMICO (CARRUSEL) -->
        <section class="container my-4">
            <div id="heroCarousel" class="carousel slide hero-banner" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="hero-slide row align-items-center g-4">
                            <div class="col-md-7 ps-md-5">
                                <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold mb-3">OFERTA DE LA SEMANA</span>
                                <h1 class="display-5 fw-extrabold mb-2">Tecnología de Vanguardia al Mejor Precio</h1>
                                <p class="lead opacity-90 mb-4">Aprovecha descuentos exclusivos en computación, telefonía y accesorios con envío a todo el país.</p>
                                <a href="#catalogo" class="btn btn-warning btn-lg rounded-pill px-4 fw-bold shadow">Explorar Ofertas &rarr;</a>
                            </div>
                            <div class="col-md-5 text-center d-none d-md-block">
                                <i class="bi bi-laptop display-1 text-warning opacity-75"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="hero-slide row align-items-center g-4" style="background: linear-gradient(135deg, #065f46 0%, #059669 100%);">
                            <div class="col-md-7 ps-md-5">
                                <span class="badge bg-white text-success px-3 py-1.5 rounded-pill fw-bold mb-3">PAGO CONTRA ENTREGA</span>
                                <h1 class="display-5 fw-extrabold mb-2">Compra Seguro desde Casa</h1>
                                <p class="lead opacity-90 mb-4">Pagas al recibir tu paquete en la puerta de tu hogar en los 22 departamentos de Guatemala.</p>
                                <a href="#catalogo" class="btn btn-light btn-lg rounded-pill px-4 fw-bold shadow text-success">Ver Productos &rarr;</a>
                            </div>
                            <div class="col-md-5 text-center d-none d-md-block">
                                <i class="bi bi-truck display-1 text-white opacity-75"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="hero-slide row align-items-center g-4" style="background: linear-gradient(135deg, #831843 0%, #db2777 100%);">
                            <div class="col-md-7 ps-md-5">
                                <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill fw-bold mb-3">NUEVA COLECCIÓN</span>
                                <h1 class="display-5 fw-extrabold mb-2">Audio, Gamers y Entretenimiento</h1>
                                <p class="lead opacity-90 mb-4">Audífonos inalámbricos, consolas, mandos y bocinas de alta calidad con garantía real.</p>
                                <a href="#catalogo" class="btn btn-warning btn-lg rounded-pill px-4 fw-bold shadow">Ver Catálogo &rarr;</a>
                            </div>
                            <div class="col-md-5 text-center d-none d-md-block">
                                <i class="bi bi-controller display-1 text-white opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. BLOQUE DE CATEGORÍAS MAPEADAS DINÁMICAMENTE DESDE LA BASE DE DATOS -->
        <section class="container mb-4">
            <div class="row g-3">
                @php
                    $categoryIcons = [
                        'laptop' => 'bi-laptop',
                        'comput' => 'bi-pc-display',
                        'celular' => 'bi-phone',
                        'telefo' => 'bi-phone',
                        'audio' => 'bi-headphones',
                        'música' => 'bi-music-note-beaming',
                        'videojuego' => 'bi-controller',
                        'consola' => 'bi-controller',
                        'tv' => 'bi-tv',
                        'video' => 'bi-tv',
                        'hogar' => 'bi-house-door',
                        'cámara' => 'bi-camera',
                        'tecnolog' => 'bi-cpu',
                    ];
                @endphp

                @foreach($categoriesList->take(6) as $cat)
                    @php
                        $iconClass = 'bi-grid-fill';
                        foreach($categoryIcons as $key => $icon) {
                            if(stripos($cat->name, $key) !== false) {
                                $iconClass = $icon;
                                break;
                            }
                        }
                    @endphp
                    <div class="col-6 col-sm-4 col-md-2">
                        <a href="{{ url('/?category=' . $cat->id) }}" class="category-card">
                            <div class="category-icon-wrapper"><i class="bi {{ $iconClass }}"></i></div>
                            <span class="small fw-bold text-truncate d-block">{{ $cat->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 6. SECCIÓN OFERTAS RELÁMPAGO -->
        <section class="container mb-5">
            <div class="flash-sale-box shadow-sm">
                <div class="row align-items-center g-3">
                    <div class="col-md-4">
                        <span class="badge bg-danger text-white mb-2 px-3 py-1">⚡ OFERTA RELÁMPAGO</span>
                        <h2 class="h3 fw-bold mb-1">¡Descuentos por tiempo limitado!</h2>
                        <p class="small text-white-50 mb-0">Precios especiales aplicados automáticamente.</p>
                    </div>
                    <div class="col-md-8 text-md-end">
                        <div class="d-inline-flex align-items-center gap-2">
                            <span class="small text-uppercase fw-bold text-warning me-2">Termina en:</span>
                            <div class="timer-badge" id="flashHours">08</div><span>:</span>
                            <div class="timer-badge" id="flashMinutes">42</div><span>:</span>
                            <div class="timer-badge" id="flashSeconds">19</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @else
        
        <!-- BREADCRUMB LIMPIO CUANDO HAY FILTRO O BÚSQUEDA ACTIVA -->
        <div class="bg-white border-bottom py-3 mb-4">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Inicio</a></li>
                        @if(request('category'))
                            <li class="breadcrumb-item active fw-bold text-primary" aria-current="page">
                                Categoría: {{ $activeCategory->name ?? 'Seleccionada' }}
                            </li>
                        @elseif(request('search'))
                            <li class="breadcrumb-item active fw-bold text-primary" aria-current="page">
                                Búsqueda: "{{ request('search') }}"
                            </li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>

    @endif

    <!-- 7. CATÁLOGO PRINCIPAL DE PRODUCTOS -->
    <main class="container mb-5" id="catalogo">
        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h4 fw-bold mb-1 text-dark">
                    @if(request('search'))
                        Resultados de búsqueda
                    @elseif($activeCategory)
                        {{ $activeCategory->name }}
                    @else
                        Todos los Productos
                    @endif
                </h2>
                <p class="small text-muted mb-0">
    Se encontraron {{ method_exists($products, 'total') ? $products->total() : $products->count() }} productos disponibles.
</p>
            </div>
            
            @if($isFiltered)
                <a href="{{ url('/') }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                    <i class="bi bi-x-circle me-1"></i> Quitar Filtros
                </a>
            @endif
        </div>

        <!-- REJILLA DE PRODUCTOS (GRID) -->
        <div class="row g-4">
            @forelse($products as $product)
                @php
                    $hasDiscount = isset($product->original_price) && $product->original_price > $product->price;
                    $discountPct = $hasDiscount ? round((($product->original_price - $product->price) / $product->original_price) * 100) : null;
                @endphp

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        
                        <!-- Badges de Descuento -->
                        @if($hasDiscount)
                            <span class="badge-discount">{{ $discountPct }}% OFF</span>
                        @endif

                        <!-- Imagen -->
                        <div class="product-card-img-wrapper">
                            <img src="{{ $product->image_url ?: 'https://via.placeholder.com/300' }}" alt="{{ $product->name }}" class="img-fluid">
                            
                            <!-- Botón Vista Rápida -->
                            <button class="btn-quick-view" onclick="openQuickView('{{ addslashes($product->name) }}', '{{ $product->image_url ?: 'https://via.placeholder.com/400' }}', 'Q {{ number_format($product->price, 2) }}', '{{ addslashes($product->description) }}', '{{ route('products.show', $product->id) }}')">
                                <i class="bi bi-eye me-1"></i> Vista Rápida
                            </button>
                        </div>

                        <!-- Cuerpo del Card -->
                        <div class="product-card-body">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="text-muted text-uppercase" style="font-size: 10px; font-weight: 700;">
                                        {{ $product->category->name ?? 'General' }}
                                    </span>
                                    <span class="text-warning small" style="font-size: 11px;">
                                        <i class="bi bi-star-fill"></i> 4.8
                                    </span>
                                </div>

                                <a href="{{ route('products.show', $product->id) }}" class="product-title mb-2">
                                    {{ $product->name }}
                                </a>
                            </div>

                            <div class="mt-3">
                                <div class="d-flex align-items-baseline gap-2 mb-2">
                                    <span class="price-current">Q {{ number_format($product->price, 2) }}</span>
                                    @if($hasDiscount)
                                        <span class="price-old">Q {{ number_format($product->original_price, 2) }}</span>
                                    @endif
                                </div>

                                <!-- Botón Agregar al Carrito -->
                                @if(Route::has('cart.add'))
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-add-cart d-flex align-items-center justify-content-center gap-2">
                                            <i class="bi bi-cart-plus-fill fs-6"></i> Agregar
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-add-cart d-flex align-items-center justify-content-center gap-2 text-decoration-none">
                                        <i class="bi bi-bag-fill fs-6"></i> Ver Producto
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 border">
                        <i class="bi bi-search display-3 text-muted mb-3 d-block"></i>
                        <h3 class="h5 fw-bold text-dark">No hay productos en esta categoría</h3>
                        <p class="text-muted small">Intenta explorar otras categorías o borra el filtro actual.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4 mt-2">Ver todo el catálogo</a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- PAGINACIÓN -->
        @if(method_exists($products, 'links'))
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        @endif

    </main>

    <!-- 8. GARANTÍAS DE COMPRA -->
    <section class="bg-white border-top border-bottom py-5 mb-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <i class="bi bi-truck display-5 text-primary mb-2 d-block"></i>
                        <h3 class="h6 fw-bold text-dark">Envíos a Todo el País</h3>
                        <p class="small text-muted mb-0">Cobertura garantizada en los 22 departamentos de Guatemala.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <i class="bi bi-cash-stack display-5 text-warning mb-2 d-block"></i>
                        <h3 class="h6 fw-bold text-dark">Pago Contra Entrega</h3>
                        <p class="small text-muted mb-0">Cancela en efectivo o tarjeta cuando recibes tu producto.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <i class="bi bi-shield-check display-5 text-success mb-2 d-block"></i>
                        <h3 class="h6 fw-bold text-dark">Garantía Asegurada</h3>
                        <p class="small text-muted mb-0">Garantía real por desperfectos de fábrica en tus compras.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-3">
                        <i class="bi bi-headset display-5 text-danger mb-2 d-block"></i>
                        <h3 class="h6 fw-bold text-dark">Soporte WhatsApp</h3>
                        <p class="small text-muted mb-0">Atención personalizada para resolver todas tus dudas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. MODAL VISTA RÁPIDA -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6 text-center">
                            <div class="p-3 bg-light rounded-4">
                                <img id="qvImage" src="" alt="" class="img-fluid" style="max-height: 260px; object-fit: contain;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="badge bg-primary mb-2">BOHEMIAN'S</span>
                            <h3 id="qvTitle" class="h4 fw-bold text-dark mb-2"></h3>
                            <div id="qvPrice" class="h3 fw-bold text-danger mb-3"></div>
                            <p id="qvDescription" class="small text-muted mb-4" style="line-height: 1.6; max-height: 120px; overflow-y: auto;"></p>
                            <a id="qvDetailBtn" href="#" class="btn btn-warning w-100 rounded-pill fw-bold py-2.5">Ver Detalle Completo &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 10. PIE DE PÁGINA (FOOTER) -->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="fw-bold text-white mb-3">BOHEMIAN'S</h5>
                    <p class="small text-secondary">La tienda en línea número uno de productos de tecnología, hogar, gadgets y mucho más en Guatemala.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold text-white mb-3">Atención al Cliente</h6>
                    <ul class="list-unstyled small text-secondary space-y-2">
                        <li><i class="bi bi-whatsapp text-success me-2"></i> Soporte por WhatsApp</li>
                        <li><i class="bi bi-truck me-2"></i> Envíos a los 22 departamentos</li>
                        <li><i class="bi bi-credit-card me-2"></i> Pago Contra Entrega</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold text-white mb-3">Garantía y Seguridad</h6>
                    <p class="small text-secondary">Tus compras están totalmente protegidas. Recibe tus productos en la puerta de tu casa.</p>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center small text-secondary">
                © {{ date('Y') }} BOHEMIAN'S. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Contador regresivo Ofertas Relámpago (Solo si existe en pantalla)
        const timerElement = document.getElementById('flashHours');
        if (timerElement) {
            let hours = 8, minutes = 42, seconds = 19;
            setInterval(() => {
                seconds--;
                if (seconds < 0) { seconds = 59; minutes--; }
                if (minutes < 0) { minutes = 59; hours--; }
                if (hours < 0) { hours = 23; }

                document.getElementById('flashHours').innerText = String(hours).padStart(2, '0');
                document.getElementById('flashMinutes').innerText = String(minutes).padStart(2, '0');
                document.getElementById('flashSeconds').innerText = String(seconds).padStart(2, '0');
            }, 1000);
        }

        // Abrir Modal de Vista Rápida
        function openQuickView(title, img, price, description, url) {
            document.getElementById('qvTitle').innerText = title;
            document.getElementById('qvImage').src = img;
            document.getElementById('qvPrice').innerText = price;
            document.getElementById('qvDescription').innerText = description || 'Sin descripción adicional.';
            document.getElementById('qvDetailBtn').href = url;

            const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
            modal.show();
        }
    </script>
</body>
</html>