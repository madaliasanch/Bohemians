<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ImportCsvProducts extends Command
{
    // Permite pasar como argumentos el nombre del archivo y el nombre de la categoría
    protected $signature = 'import:csv {file=productos.csv : Nombre del archivo en database/seeders/} {category=General : Nombre de la categoría}';
    protected $description = 'Importa productos desde un CSV asignándoles la categoría especificada';

    public function handle()
    {
        $filename = $this->argument('file');
        $categoryName = $this->argument('category');
        $filePath = database_path('seeders/' . $filename);

        if (!file_exists($filePath)) {
            $this->error("No se encontró el archivo '{$filename}' en la carpeta database/seeders/");
            return 1;
        }

        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file, 0, ',');

        if (!$headers) {
            $this->error("El archivo CSV está vacío.");
            return 1;
        }

        // Crea o busca automáticamente la categoría que le indiques
        $category = Category::firstOrCreate(
            ['slug' => Str::slug($categoryName)],
            ['name' => $categoryName]
        );

        $this->info("Iniciando importación para la categoría: '{$category->name}' desde '{$filename}'...");

        $importedCount = 0;

        while (($row = fgetcsv($file, 0, ',')) !== false) {
            if (empty($row) || count($row) < 2) continue;

            $name = null;
            $price = 0;
            $imageUrl = null;

            foreach ($row as $cell) {
                $val = trim($cell);
                if (empty($val)) continue;

                // Extraer Imagen
                if (empty($imageUrl) && (str_contains($val, 'kemikcdn') || preg_match('/\.(jpg|jpeg|png|webp)/i', $val))) {
                    $imageUrl = $val;
                }

                // Extraer Precio
                if ($price == 0 && preg_match('/Q\s*([\d,]+(?:\.\d+)?)/i', $val, $matches)) {
                    $pClean = str_replace(',', '', $matches[1]);
                    $pFloat = floatval($pClean);
                    if ($pFloat > 0) {
                        $price = $pFloat;
                    }
                }

                // Extraer Nombre desde la URL
                if (empty($name) && str_contains($val, 'kemik.gt/') && !preg_match('/\.(jpg|jpeg|png|webp)/i', $val)) {
                    $path = parse_url($val, PHP_URL_PATH);
                    $slug = trim($path, '/');
                    
                    if (!empty($slug)) {
                        $cleanTitle = Str::of($slug)->replace('-', ' ')->title();
                        $name = (string) $cleanTitle;
                    }
                }
            }

            if (!empty($name)) {
                if ($price == 0) {
                    $price = 199.00;
                }

                Product::updateOrCreate(
                    ['name' => $name],
                    [
                        'category_id' => $category->id,
                        'description' => "Producto de la categoría {$category->name}: {$name}. Disponible con envío a todo el país.",
                        'price' => $price,
                        'stock' => rand(5, 25),
                        'image_url' => $imageUrl ?: 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=600&q=80',
                    ]
                );

                $this->info("Importado [{$category->name}]: {$name} - Q{$price}");
                $importedCount++;
            }
        }

        fclose($file);

        $this->info("--------------------------------------------------");
        $this->info("¡Éxito! Se importaron {$importedCount} productos a la categoría '{$category->name}'.");
        return 0;
    }
}