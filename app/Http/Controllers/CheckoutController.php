<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'El carrito está vacío.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'department' => 'required|string',
            'address'    => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Tu carrito está vacío.');
        }

        try {
            // Transacción para descontar stock de la base de datos de forma segura
            DB::transaction(function () use ($cart) {
                foreach ($cart as $id => $details) {
                    $product = Product::findOrFail($id);

                    // Verifica si hay existencias suficientes
                    if ($product->stock >= $details['quantity']) {
                        $product->decrement('stock', $details['quantity']);
                    } else {
                        throw new \Exception("Stock insuficiente para: {$product->name}");
                    }
                }
            });

            // Limpia la sesión del carrito al completar el pedido
            session()->forget('cart');

            return redirect()->route('home')->with('success', '¡Pedido realizado exitosamente! Pronto te contactaremos para la entrega.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}