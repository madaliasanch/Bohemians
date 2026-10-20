<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Producto - Bohemian's Admin</title>

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
                <i class="bi bi-arrow-left me-1"></i> Volver al Dashboard
            </a>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 800px;">
        
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle-fill text-warning me-2"></i>Agregar Nuevo Producto</h4>
            <p class="text-muted small mb-4">Completa la información del producto para añadirlo al catálogo general.</p>

            <form method="POST" action="{{ route('productos.store') }}">
                @csrf

                <!-- Nombre del Producto -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small text-muted">Nombre del Producto</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Ej: Laptop ASUS ROG Strix" required autofocus>
                    @error('name')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <!-- Marca -->
                    <div class="col-md-6">
                        <label for="brand" class="form-label fw-semibold small text-muted">Marca</label>
                        <input type="text" id="brand" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" placeholder="Ej: ASUS, Apple, Samsung" required>
                        @error('brand')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-semibold small text-muted">Categoría</label>
                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Selecciona una categoría...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <!-- Precio en Quetzales -->
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold small text-muted">Precio (Q)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted">Q</span>
                            <input type="number" step="0.01" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="0.00" required>
                        </div>
                        @error('price')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Stock en Existencia -->
                    <div class="col-md-6">
                        <label for="stock" class="form-label fw-semibold small text-muted">Stock Inicial</label>
                        <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 10) }}" min="0" required>
                        @error('stock')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- URL de la Imagen -->
                <div class="mb-3">
                    <label for="image_url" class="form-label fw-semibold small text-muted">URL de la Imagen (Opcional)</label>
                    <input type="url" id="image_url" name="image_url" class="form-control @error('image_url') is-invalid @enderror" value="{{ old('image_url') }}" placeholder="https://ejemplo.com/imagen.jpg">
                    <span class="form-text text-muted small">Si se deja vacío, se asignará una imagen por defecto.</span>
                    @error('image_url')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold small text-muted">Descripción del Producto</label>
                    <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Escribe los detalles o especificaciones principales del producto...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 fw-bold">Cancelar</a>
                    <button type="submit" class="btn btn-boh-yellow rounded-pill px-4 fw-bold">
                        <i class="bi bi-save me-1"></i> Guardar Producto
                    </button>
                </div>

            </form>
        </div>

    </div>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>