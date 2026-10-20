<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>¡Pedido Confirmado! - Bohemian's</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div class="max-w-2xl mx-auto px-4 my-12 text-center">
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto text-3xl mb-4">
                ✓
            </div>

            <h1 class="text-2xl font-black text-gray-900 mb-2">¡Gracias por tu compra!</h1>
            <p class="text-gray-600 text-sm mb-6">Hemos recibido tu pedido exitosamente.</p>

            <div class="bg-gray-50 rounded-md p-4 text-left text-xs space-y-2 mb-6 border">
                <div class="flex justify-between font-bold text-gray-800 border-b pb-2">
                    <span>Número de Orden:</span>
                    <span class="text-blue-600">{{ $orderData['order_number'] }}</span>
                </div>
                <p><strong>Cliente:</strong> {{ $orderData['customer_name'] }}</p>
                <p><strong>Teléfono:</strong> {{ $orderData['phone'] }}</p>
                <p><strong>Dirección:</strong> {{ $orderData['address'] }}, {{ $orderData['department'] }}</p>
                <p><strong>Total a pagar (Contra Entrega):</strong> <span class="font-bold text-gray-900 text-sm">Q{{ number_format($orderData['total'], 2) }}</span></p>
            </div>

            <a href="{{ url('/') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg text-sm transition-colors shadow">
                Volver a la Tienda
            </a>
        </div>

    </div>

</body>
</html>