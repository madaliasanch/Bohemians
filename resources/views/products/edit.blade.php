<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('productos.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Obligatorio para actualizar en Laravel -->
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nombre del Producto</label>
                            <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Categoría</label>
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Marca y Precio -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Marca</label>
                            <input type="text" name="brand" value="{{ $product->brand }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Precio (Q)</label>
                            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Descuento y Stock -->
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Descuento (%)</label>
                            <input type="number" name="discount_percentage" value="{{ $product->discount_percentage }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Cantidad en Inventario</label>
                            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <!-- URL de Imagen y Descripción -->
                    <div class="mt-6">
                        <label class="block text-gray-700 font-bold mb-2">URL de la Imagen</label>
                        <input type="text" name="image_url" value="{{ $product->image_url }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mt-6">
                        <label class="block text-gray-700 font-bold mb-2">Descripción Detallada</label>
                        <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ $product->description }}</textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded border border-gray-900">
                            Actualizar Producto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>