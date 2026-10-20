<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Productos - Bohemian's Admin</title>

    <!-- Bootstrap 5.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --boh-primary: #0f172a;
            --boh-dark-blue: #020617;
            --boh-yellow: #f59e0b;
        }

        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .bg-boh-dark { background-color: var(--boh-dark-blue) !important; }
        .btn-boh-yellow {
            background-color: var(--boh-yellow);
            color: #020617;
            font-weight: 700;
            border: none;
        }
    </style>
</head>
<body>

    <!-- Header Navbar Admin -->
    <nav class="navbar navbar-expand-lg bg-boh-dark navbar-dark py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-black fs-3 tracking-wider" href="{{ route('dashboard') }}">
                BOHEMIAN'S <span class="badge bg-warning text-dark fs-6 ms-2">Admin Panel</span>
            </a>
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 fw-bold">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
            </a>
        </div>
    </nav>

    <div class="container my-5">
        
        <!-- Alerta de Éxito -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Catálogo de Productos</h3>
                <p class="text-muted small mb-0">Total registrados: {{ $products->total() }} artículos</p>
            </div>

            <a href="{{ route('productos.create') }}" class="btn btn-boh-yellow rounded-pill px-4 fw-bold shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Crear Producto
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light small text-uppercase">
                        <tr>
                            <th class="ps-4">Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-3" style="width: 48px; height: 48px; object-fit: contain; background: #f1f5f9;">
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark">{{ $product->name }}</h6>
                                            <small class="text-muted">{{ $product->brand }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill">
                                        {{ $product->category->name ?? 'Sin Categoría' }}
                                    </span>
                                </td>
                                <td class="fw-bold text-dark">Q{{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->stock <= 5)
                                        <span class="badge bg-danger text-white rounded-pill">{{ $product->stock }} un. (Bajo)</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success rounded-pill fw-bold">{{ $product->stock }} un.</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <form method="POST" action="{{ route('productos.destroy', $product->id) }}" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle p-2" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    No hay productos registrados por el momento.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="p-3 border-top">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>