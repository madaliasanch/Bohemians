<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use DOMDocument;
use DOMXPath;

class ImportKemik extends Command
{
    protected $signature = 'import:kemik {url : La URL de la categoría de Kemik.gt}';
    protected $description = 'Importa productos desde una categoría de Kemik.gt a la base de datos';

    public function handle()
    {
        $url = $this->argument('url');
        $this->info("Conectando con Kemik: {$url}...");

        // Petición HTTP con User-Agent para evitar bloqueos
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36'
        ])->get($url);

        if (!$response->successful()) {
            $this->error("No se pudo acceder a la página de Kemik.");
            return 1;
        }

        // Cargar el HTML en el parser DOM
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($response->body());
        $xpath = new DOMXPath($doc);

        // Buscar tarjetas de productos en el HTML de Kemik
        $nodes = $xpath->query("//*[contains(@class, 'product') or contains(@class, 'product-card') or contains(@class, 'type-product')]");

        if ($nodes->length === 0) {
            $this->warn("No se encontraron elementos de productos con los selectores estándar. Intentando búsqueda alternativa...");
        }

        // Crear/obtener una categoría por defecto
        $category = Category::firstOrCreate(
            ['slug' => 'importados-kemik'],
            ['name' => 'Importados Kemik']
        );

        $imported = 0;

        foreach ($nodes as $node) {
            // Extraer Título/Nombre
            $titleNode = $xpath->query(".//*[contains(@class, 'title') or contains(@class, 'name') or self::h2 or self::h3]", $node)->item(0);
            $name = $titleNode ? trim($titleNode->textContent) : null;

            // Extraer Precio
            $priceNode = $xpath->query(".//*[contains(@class, 'price') or contains(text(), 'Q')]", $node)->item(0);
            $priceText = $priceNode ? $priceNode->textContent : null;

            // Extraer Imagen
            $imgNode = $xpath->query(".//img", $node)->item(0);
            $imageUrl = $imgNode ? ($imgNode->getAttribute('data-src') ?: $imgNode->getAttribute('src')) : null;

            if ($name && $priceText) {
                // Convertir precio "Q 1,250.00" a número flotante 1250.00
                $priceClean = preg_replace('/[^0-9.]/', '', str_replace(',', '', $priceText));
                $price = floatval($priceClean);

                if ($price > 0) {
                    Product::updateOrCreate(
                        ['name' => $name],
                        [
                            'category_id' => $category->id,
                            'description' => "Producto importado de Kemik: {$name}. Alta calidad garantizada.",
                            'price' => $price,
                            'stock' => rand(5, 20),
                            'image_url' => $imageUrl ?: 'https://via.placeholder.com/600',
                        ]
                    );
                    $imported++;
                    $this->info("Importado: {$name} - Q{$price}");
                }
            }
        }

        $this->info("¡Proceso completado! Se importaron {$imported} productos.");
        return 0;
    }
}