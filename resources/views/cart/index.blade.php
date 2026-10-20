<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de Compras - Bohemian's</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        /* Clases de Identidad Bohemian's */
        .bg-boh-dark { background-color: var(--boh-dark-blue) !important; }
        .bg-boh-primary { background-color: var(--boh-primary) !important; }
        .bg-boh-subnav { background-color: var(--boh-subnav) !important; }
        .text-boh-primary { color: var(--boh-primary) !important; }
        .text-boh-yellow { color: var(--boh-yellow) !important; }

        /* Botón Principal Dorado Bohemian's */
        .btn-boh-yellow {
            background-color: var(--boh-yellow);
            color: #020617;
            font-weight: 700;
            border: none;
            transition: all 0.2s ease-in-out;
        }
        .btn-boh-yellow:hover, 
        .btn-boh-yellow:focus {
            background-color: var(--boh-yellow-hover);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        }

        /* Botón Secundario / Volver */
        .btn-outline-boh-light {
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.2s ease-in-out;
        }
        .btn-outline-boh-light:hover {
            background-color: var(--boh-subnav);
            color: var(--boh-yellow);
            border-color: var(--boh-yellow);
        }

        /* Badge Personalizado */
        .badge-boh-primary {
            background-color: var(--boh-primary);
            color: #ffffff;
        }
    </style>
</head>
<body>
    
    <!-- Navegación con Color Negro Profundo Header -->
    <nav class="navbar navbar-expand-lg bg-boh-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-black fs-3 text-white tracking-wider" href="{{ url('/') }}">
                BOHEMIAN'S
            </a>
            <a href="{{ url('/') }}" class="btn btn-outline-boh-light btn-sm rounded-pill fw-bold px-3">
                <i class="bi bi-arrow-left me-1"></i> Volver a la Tienda
            </a>
        </div>
    </nav>

    <div class="container my-5">
        
        <!-- Alerta de Éxito -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="row g-4">
                
                <!-- Columna Izquierda: Tabla de Productos (8 Columnas) -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-boh-primary text-white py-3 px-4 border-0">
                            <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                                <i class="bi bi-cart3 me-2 text-boh-yellow"></i>Tu Carrito
<span class="badge bg-boh-subnav text-boh-yellow rounded-pill ms-auto fs-6">
    {{ collect($cart)->sum('quantity') }} {{ collect($cart)->sum('quantity') == 1 ? 'unidad' : 'unidades' }}
</span>
                            </h5>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light text-uppercase fs-7 text-muted">
                                        <tr>
                                            <th scope="col" class="ps-4 py-3">Producto</th>
                                            <th scope="col" class="text-center py-3">Precio</th>
                                            <th scope="col" class="text-center py-3">Cantidad</th>
                                            <th scope="col" class="text-center py-3">Subtotal</th>
                                            <th scope="col" class="text-end pe-4 py-3">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach($cart as $id => $details)
                                            @php 
                                                $subtotal = $details['price'] * $details['quantity']; 
                                                $total += $subtotal; 
                                            @endphp
                                            <tr>
                                                <!-- Imagen + Nombre -->
                                                <td class="ps-4 py-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if(!empty($details['image_url']))
                                                            <div class="rounded-3 border bg-white p-1 d-flex align-items-center justify-content-center shadow-sm" style="width: 64px; height: 64px;">
                                                                <img src="{{ $details['image_url'] }}" alt="{{ $details['name'] }}" class="img-fluid max-h-100 object-fit-contain rounded">
                                                            </div>
                                                        @else
                                                            <div class="rounded-3 bg-secondary-subtle d-flex align-items-center justify-content-center text-muted fw-bold fs-7" style="width: 64px; height: 64px;">
                                                                Sin img
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-boh-primary">{{ $details['name'] }}</h6>
                                                            <small class="text-muted">Ref: #{{ $id }}</small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Precio Unitario -->
                                                <td class="text-center font-monospace fw-semibold">
                                                    Q{{ number_format($details['price'], 2) }}
                                                </td>

                                                <!-- Cantidad -->
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-3">
                                                        {{ $details['quantity'] }}
                                                    </span>
                                                </td>

                                                <!-- Subtotal -->
                                                <td class="text-center font-monospace fw-bold text-boh-primary fs-6">
                                                    Q{{ number_format($subtotal, 2) }}
                                                </td>

                                                <!-- Botón Eliminar -->
                                                <td class="text-end pe-4">
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 px-2 py-1" title="Eliminar producto">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Resumen de Compra (4 Columnas) -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 text-boh-primary border-bottom pb-3">Resumen de Compra</h5>

                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>Subtotal</span>
                                <span class="font-monospace fw-semibold text-dark">Q{{ number_format($total, 2) }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-3 text-muted">
                                <span>Envío</span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Calculado en checkout</span>
                            </div>

                            <hr class="my-3">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold fs-5 text-boh-primary">Total</span>
                                <span class="fw-black fs-3 text-boh-primary font-monospace">Q{{ number_format($total, 2) }}</span>
                            </div>

                            <!-- Botón Procesar Pedido (Dorado Bohemian's) -->
                            <a href="{{ route('checkout.index') }}" class="btn btn-boh-yellow btn-lg w-100 rounded-3 py-3 mb-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                Procesar Pedido <i class="bi bi-arrow-right"></i>
                            </a>

                            <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-muted w-100 text-center small fw-semibold mt-1">
                                Seguir comprando
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        @else
            <!-- Estado Carrito Vacío -->
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-5 max-w-lg mx-auto">
                <div class="card-body">
                    <div class="bg-boh-primary text-boh-yellow rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 80px; height: 80px;">
                        <i class="bi bi-cart-x fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-boh-primary mb-2">Tu carrito está vacío</h3>
                    <p class="text-muted mb-4">Parece que aún no has agregado ningún producto a tu carrito de compras.</p>
                    <a href="{{ url('/') }}" class="btn btn-boh-yellow btn-lg rounded-3 px-4 shadow-sm">
                        <i class="bi bi-shop me-2"></i> ¡Empieza a comprar!
                    </a>
                </div>
            </div>
        @endif

    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>