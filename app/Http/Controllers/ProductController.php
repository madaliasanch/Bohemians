<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Lista de productos (Administrador)
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.productos.index', compact('products'));
    }

    /**
     * Formulario para crear producto
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.productos.create', compact('categories'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|url',
        ]);

        $validated['rating'] = 5.0;
        $validated['reviews_count'] = 0;
        
        if (empty($validated['image_url'])) {
            $validated['image_url'] = 'https://via.placeholder.com/300x300?text=Sin+Imagen';
        }

        Product::create($validated);

        return redirect()->route('productos.index')->with('success', '¡Producto creado exitosamente!');
    }

    /**
     * Ver producto (Vista Pública)
     */
/**
     * Ver producto individual (Vista Pública)
     */
    public function show(Product $product)
    {
        // 1. Obtener todas las categorías para la barra de navegación superior
        $categories = Category::all();

        // 2. Obtener productos relacionados de la misma categoría (excluyendo el actual)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'categories', 'relatedProducts'));
    }
    /**
     * Formulario de edición
     */
    public function edit(Product $producto)
    {
        $categories = Category::all();
        return view('admin.productos.edit', ['product' => $producto, 'categories' => $categories]);
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, Product $producto)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|url',
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', '¡Producto actualizado correctamente!');
    }

    /**
     * Eliminar producto
     */
    public function destroy(Product $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', '¡Producto eliminado correctamente!');
    }
}