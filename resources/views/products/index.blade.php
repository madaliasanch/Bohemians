<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administración de Productos - Bohemian's</title>

    <!-- Bootstrap 5.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --boh-primary: #0f172a;       /* Azul Noche / Carbón */
            --boh-dark-blue: #020617;     /* Negro Profundo Header */
            --boh-subnav: #1e293b;        /* Gris Pizarra Oscuro */
            --boh-yellow: #f59e0b;        /* Ámbar / Dorado Cálido */
            --boh-yellow-hover: #d97706;  /* Dorado Hover */
        }

        body {
            background-color: #f4f6f9;
            color: #2b2b2b;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .bg-boh-dark { background-color: var(--boh-dark-blue) !important; }
        .bg-boh-primary { background-color: var(--boh-primary) !important; }
        .bg-boh-subnav { background-color: var(--boh-subnav) !important; }
        .text-boh-primary { color: var(--boh-primary) !important; }
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
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        }

        .btn-outline-boh-light {
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-outline-boh-light:hover {
            background-color: var(--boh-subnav);
            color: var(--boh-yellow);
        }
    </style>
</head>
<body>

    <!-- Header de Administración -->
    <nav class="navbar navbar-expand-lg bg-boh-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-black fs-3 text-white tracking-wider" href="{{ url('/') }}">
                BOHEMIAN'S <span class="fs-6 text-boh-yellow ms-2">| Admin</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/') }}" class="btn btn-outline-boh-light btn-sm rounded-pill fw-bold px-3">
                    <i class="bi bi-shop me-1"></i> Ir a la Tienda
                </a>
            </div>
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

        <!-- Encabezado de Sección y Botón Agregar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold text-boh-primary mb-1">
                    <i class="bi bi-box-seam me-2 text-boh-yellow"></i>Gestión de Productos
                </h3>
                <p class="text-muted small mb-0">Administra el inventario, precios y detalles de tus productos.</p>
            </div>
            <div>
                <a href="{{ route('productos.create') }}" class="btn btn-boh-yellow rounded-3 px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-lg fs-5"></i> Agregar Nuevo Producto
                </a>
            </div>
        </div>

        <!-- Tarjeta con la Tabla de Productos -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-boh-primary text-white fs-7 text-uppercase">
                            <tr>
                                <th scope="col" class="ps-4 py-3">ID</th>
                                <th scope="col" class="py-3">Producto</th>
                                <th scope="col" class="py-3">Categoría</th>
                                <th scope="col" class="text-center py-3">Precio</th>
                                <th scope="col" class="text-center py-3">Stock</th>
                                <th scope="col" class="text-end pe-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <!-- ID -->
                                    <td class="ps-4 fw-bold text-muted">
                                        #{{ $product->id }}
                                    </td>

                                    <!-- Imagen + Nombre + Marca -->
                                    <td class="py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            @if(!empty($product->image_url))
                                                <div class="rounded-3 border bg-white p-1 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid max-h-100 object-fit-contain rounded">
                                                </div>
                                            @else
                                                <div class="rounded-3 bg-secondary-subtle d-flex align-items-center justify-content-center text-muted fw-bold fs-7" style="width: 50px; height: 50px;">
                                                    Sin img
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 fw-bold text-boh-primary">{{ $product->name }}</h6>
                                                @if(!empty($product->brand))
                                                    <small class="text-muted">Marca: {{ $product->brand }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Categoría -->
                                    <td>
                                        @if(isset($product->category))
                                            <span class="badge bg-light text-boh-primary border px-3 py-1 rounded-pill">
                                                {{ $product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted small">Sin categoría</span>
                                        @endif
                                    </td>

                                    <!-- Precio -->
                                    <td class="text-center font-monospace fw-bold text-boh-primary">
                                        Q{{ number_format($product->price, 2) }}
                                    </td>

                                    <!-- Stock con Indicador Visual -->
                                    <td class="text-center">
                                        @if($product->stock > 5)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill">
                                                {{ $product->stock }} un.
                                            </span>
                                        @elseif($product->stock > 0)
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill">
                                                {{ $product->stock }} un. (Bajo)
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill">
                                                Agotado
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Botones de Acción -->
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <!-- Ver Detalle en Tienda -->
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary btn-sm rounded-2" title="Ver Detalle" target="_blank">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Editar Producto -->
                                            <a href="{{ route('productos.edit', $product->id) }}" class="btn btn-outline-primary btn-sm rounded-2" title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <!-- Eliminar Producto -->
                                            <form action="{{ route('productos.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-2" title="Eliminar">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                        No hay productos registrados en el sistema.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Links de Paginación (si se usa paginate() en el controlador) -->
            @if(method_exists($products, 'links'))
                <div class="card-footer bg-white border-0 py-3 px-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>