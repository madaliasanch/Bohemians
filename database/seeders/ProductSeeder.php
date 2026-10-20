<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Genera la categoría asignándole su slug correspondiente
        $getCategory = function ($name) {
            return Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        };

        $catLaptops   = $getCategory('Laptops y Computación');
        $catCelulares = $getCategory('Celulares y Telefonía');
        $catAudio     = $getCategory('Audio y Música');
        $catGaming    = $getCategory('Videojuegos y Consolas');
        $catTV        = $getCategory('TV y Video');
        $catCamaras   = $getCategory('Cámaras y Fotografía');

        $productos = [
            [
                'category_id' => $catLaptops->id,
                'name' => 'Laptop Gamer ASUS ROG Strix G15',
                'description' => 'Pantalla 15.6" 144Hz, AMD Ryzen 7, NVIDIA RTX 3060, 16GB RAM, 512GB SSD. Ideal para gaming pesado y diseño.',
                'price' => 11500.00,
                'stock' => 5,
                'image_url' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catCelulares->id,
                'name' => 'Samsung Galaxy S23 Ultra 5G',
                'description' => 'Smartphone Android de 256GB, cámara de 200MP, batería de 5000mAh y S-Pen incluido. Color Phantom Black.',
                'price' => 9999.00,
                'stock' => 12,
                'image_url' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catAudio->id,
                'name' => 'Audífonos Sony WH-1000XM5',
                'description' => 'Audífonos inalámbricos con la mejor cancelación de ruido de la industria, hasta 30 horas de batería.',
                'price' => 2899.00,
                'stock' => 8,
                'image_url' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catLaptops->id,
                'name' => 'Monitor LG UltraGear 27"',
                'description' => 'Monitor Gaming QHD 144Hz, 1ms de respuesta, compatible con NVIDIA G-Sync y AMD FreeSync.',
                'price' => 3150.00,
                'stock' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catGaming->id,
                'name' => 'Teclado Mecánico Razer BlackWidow',
                'description' => 'Switches mecánicos Green, iluminación Chroma RGB personalizable. Teclado en español.',
                'price' => 1100.00,
                'stock' => 20,
                'image_url' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catLaptops->id,
                'name' => 'Apple MacBook Air M2',
                'description' => 'Chip M2, CPU de 8 núcleos, pantalla Liquid Retina de 13.6", 8GB RAM, 256GB SSD. Color Midnight.',
                'price' => 10500.00,
                'stock' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catGaming->id,
                'name' => 'Consola PlayStation 5 Standard',
                'description' => 'Consola de nueva generación con lector de discos, incluye 1 control DualSense y Astro\'s Playroom.',
                'price' => 5500.00,
                'stock' => 10,
                'image_url' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catGaming->id,
                'name' => 'Silla Gamer Secretlab Titan',
                'description' => 'Silla ergonómica de cuero PU de primera calidad, soporte lumbar integrado y cojín magnético.',
                'price' => 4200.00,
                'stock' => 6,
                'image_url' => 'https://images.unsplash.com/photo-1598550476439-6847785fcea6?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catTV->id,
                'name' => 'Smart TV Samsung 65" 4K UHD',
                'description' => 'Televisor inteligente Crystal UHD 4K, diseño sin bordes, procesador 4K y compatibilidad con asistentes de voz.',
                'price' => 6200.00,
                'stock' => 7,
                'image_url' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catCamaras->id,
                'name' => 'Cámara Canon EOS Rebel T7',
                'description' => 'Cámara réflex digital con lente de 18-55mm, sensor de 24.1 MP, Wi-Fi integrado y grabación en Full HD.',
                'price' => 4500.00,
                'stock' => 3,
                'image_url' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catAudio->id,
                'name' => 'Bocina Bluetooth JBL Flip 6',
                'description' => 'Altavoz portátil resistente al agua y al polvo (IP67), hasta 12 horas de reproducción, sonido potente.',
                'price' => 950.00,
                'stock' => 25,
                'image_url' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'category_id' => $catGaming->id,
                'name' => 'Nintendo Switch OLED',
                'description' => 'Pantalla OLED de 7 pulgadas, almacenamiento interno de 64 GB y soporte ajustable ancho.',
                'price' => 3800.00,
                'stock' => 9,
                'image_url' => 'https://images.unsplash.com/photo-1617096200347-cb04ae810b1d?auto=format&fit=crop&w=600&q=80',
            ]
        ];

        foreach ($productos as $producto) {
            Product::create($producto);
        }
    }
}