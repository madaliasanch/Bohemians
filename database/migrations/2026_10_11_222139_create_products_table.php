<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('offer_price', 10, 2)->nullable(); // Por si algún producto trae precio de oferta
            $table->integer('stock')->default(15);             // Stock inicial predeterminado
            $table->decimal('rating', 3, 2)->default(5.0);      // Ej: 4.9, 5.0
            $table->integer('reviews_count')->default(0);       // Cantidad de opiniones
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->text('product_url')->nullable();           // Enlace original por si se necesita
            
            // Relación con categoría
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};