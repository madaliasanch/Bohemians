<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finalizar Compra - Bohemian's</title>
    
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

        /* Enfoque en Inputs personalizado */
        .form-control:focus, 
        .form-select:focus {
            border-color: var(--boh-yellow);
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
        }

        /* Tarjeta de Método de Pago Seleccionada */
        .payment-option-selected {
            border: 2px solid var(--boh-yellow) !important;
            background-color: rgba(245, 158, 11, 0.06);
        }
    </style>
</head>
<body>

    <!-- Header Superior -->
    <nav class="navbar navbar-expand-lg bg-boh-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-black fs-3 text-white tracking-wider" href="{{ url('/') }}">
                BOHEMIAN'S
            </a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-boh-light btn-sm rounded-pill fw-bold px-3">
                <i class="bi bi-arrow-left me-1"></i> Volver al Carrito
            </a>
        </div>
    </nav>

    <div class="container my-5">
        
        <div class="d-flex align-items-center mb-4">
            <div class="bg-boh-primary text-boh-yellow rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 48px; height: 48px;">
                <i class="bi bi-credit-card-2-front fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold text-boh-primary mb-0">Finalizar Compra</h3>
                <p class="text-muted small mb-0">Ingresa tus datos de envío para procesar tu pedido</p>
            </div>
        </div>

        <div class="row g-4">
            
            <!-- COLUMNA IZQUIERDA: FORMULARIO DE ENVÍO (7/12) -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-boh-primary text-white py-3 px-4 border-0">
                        <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                            <i class="bi bi-truck me-2 text-boh-yellow"></i>Información de Entrega
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                
                                <!-- Nombre Completo -->
                                <div class="col-12">
                                    <label class="form-label fw-bold text-boh-primary small uppercase">Nombre Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person text-muted"></i></span>
                                        <input type="text" name="name" required placeholder="Ej. Juan Pérez" class="form-control rounded-end-3 py-2">
                                    </div>
                                </div>

                                <!-- Teléfono -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-boh-primary small uppercase">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-telephone text-muted"></i></span>
                                        <input type="text" name="phone" required placeholder="Ej. 55554444" class="form-control rounded-end-3 py-2">
                                    </div>
                                </div>

                                <!-- Departamento -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-boh-primary small uppercase">Departamento</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-geo-alt text-muted"></i></span>
                                        <select name="department" required class="form-select rounded-end-3 py-2">
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Quetzaltenango">Quetzaltenango</option>
                                            <option value="Escuintla">Escuintla</option>
                                            <option value="Alta Verapaz">Alta Verapaz</option>
                                            <option value="Otro">Otro Departamento</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Dirección Exacta -->
                                <div class="col-12">
                                    <label class="form-label fw-bold text-boh-primary small uppercase">Dirección Exacta de Entrega</label>
                                    <textarea name="address" rows="3" required placeholder="Zona, Calle, Avenida, Número de Casa o Referencias..." class="form-control rounded-3 p-3"></textarea>
                                </div>

                                <!-- Método de Pago -->
                                <div class="col-12 pt-3 border-top mt-4">
                                    <label class="form-label fw-bold text-boh-primary small uppercase mb-3">Método de Pago</label>
                                    
                                    <div class="p-3 rounded-3 payment-option-selected d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <input type="radio" checked readonly class="form-check-input mt-0" style="width: 20px; height: 20px; accent-color: var(--boh-yellow);">
                                            <div>
                                                <h6 class="mb-0 fw-bold text-boh-primary">💵 Pago Contra Entrega (Efectivo)</h6>
                                                <small class="text-muted">Pagas al recibir tu producto en la puerta de tu casa</small>
                                            </div>
                                        </div>
                                        <span class="badge bg-boh-primary text-boh-yellow px-3 py-2 rounded-pill">Seguro</span>
                                    </div>
                                </div>

                                <!-- Botón de Confirmación -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-boh-yellow btn-lg w-100 rounded-3 py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-check-circle-fill fs-5"></i> Confirmar y Realizar Pedido
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- COLUMNA DERECHA: RESUMEN DE LA ORDEN (5/12) -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 text-boh-primary border-bottom pb-3 d-flex align-items-center justify-content-between">
                            <span>Resumen del Pedido</span>
                          <span class="badge bg-boh-subnav text-boh-yellow rounded-pill fs-7">
    {{ collect($cart)->sum('quantity') }} {{ collect($cart)->sum('quantity') == 1 ? 'unidad' : 'unidades' }}
</span>
                        </h5>

                        @php $total = 0; @endphp
                        
                        <!-- Lista de productos scrolleable -->
                        <div class="pe-1 mb-3" style="max-height: 280px; overflow-y: auto;">
                            @foreach($cart as $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity']; 
                                    $total += $subtotal; 
                                @endphp
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                                    <div class="me-3">
                                        <h6 class="mb-0 fw-bold text-dark fs-6">{{ $details['name'] }}</h6>
                                        <small class="text-muted">Cantidad: <strong class="text-boh-primary">{{ $details['quantity'] }}</strong></small>
                                    </div>
                                    <span class="font-monospace fw-bold text-boh-primary">Q{{ number_format($subtotal, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desglose de Totales -->
                        <div class="bg-light p-3 rounded-3 mb-3">
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <span class="small">Subtotal productos:</span>
                                <span class="font-monospace fw-semibold text-dark">Q{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted">Costo de envío:</span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold">¡GRATIS!</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="fw-bold fs-5 text-boh-primary">Total a Pagar:</span>
                            <span class="fw-black fs-2 text-boh-primary font-monospace">Q{{ number_format($total, 2) }}</span>
                        </div>

                        <div class="alert alert-warning border-0 bg-warning-subtle text-dark rounded-3 mt-4 mb-0 p-3 small d-flex gap-2 align-items-center">
                            <i class="bi bi-shield-check fs-4 text-warning-emphasis"></i>
                            <div>
                                <strong>Garantía Bohemian's:</strong> Revisa tu paquete al recibir antes de realizar tu pago en efectivo.
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>