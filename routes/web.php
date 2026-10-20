<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Rutas Públicas / Catálogo
|--------------------------------------------------------------------------
*/
Route::get('/', function (Request $request) {
    $categories = Category::all();
    $query = Product::where('stock', '>', 0);

    // Filtro por Categoría
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Filtro por Búsqueda (Nombre o Marca)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('brand', 'LIKE', "%{$search}%");
        });
    }

    $products = $query->get();

    return view('welcome', compact('products', 'categories'));
})->name('home');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Rutas del Carrito de Compras
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Rutas de Checkout
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas (Dashboard y Perfil)
|--------------------------------------------------------------------------
*/
// DASHBOARD SEGÚN EL ROL DEL USUARIO
// DASHBOARD SEGÚN EL ROL DEL USUARIO
Route::get('/dashboard', function () {
    $user = auth()->user();

    // 1. SI ES ADMINISTRADOR
    if ($user->isAdmin()) {
        $totalProducts    = \App\Models\Product::count();
        $totalCategories  = \App\Models\Category::count();
        $lowStockProducts = \App\Models\Product::where('stock', '<=', 5)->get();

        return view('dashboard', compact('totalProducts', 'totalCategories', 'lowStockProducts'));
    }

    // 2. SI ES CLIENTE: Obtener sus pedidos recientes (si existe la relación u órdenes en sesión)
    $orders = method_exists($user, 'orders') ? $user->orders()->latest()->take(5)->get() : collect([]);

    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');



// RUTAS DE PERFIL
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// RUTAS ADMINISTRADOR
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::resource('productos', ProductController::class);
});

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación de Laravel Breeze (OBLIGATORIAS PARA EL LOGIN)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';