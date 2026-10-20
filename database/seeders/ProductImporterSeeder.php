<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductImporterSeeder extends Seeder
{
    public function run(): void
    {
        @ini_set('auto_detect_line_endings', true);

        $path = database_path('seeders');
        $files = File::files($path);

        $knownBrands = [
            'samsung', 'apple', 'ugreen', 'argom', 'ekiipa', 'kingston', 'etouch', 
            'xiaomi', 'prudence', 'scudo', 'postpil', 'ninja', 'canon', 'epson', 
            'paper mate', 'ikone', 'logitech', 'dell', 'hp', 'lenovo', 'sandisk', 
            '3m', 'bic', 'stanley', 'oster', 'black & decker', 'whirlpool', 'lg', 
            'motorola', 'huawei', 'honor', 'realme', 'tplink', 'tp-link', 'toshiba', 
            'seagate', 'wd', 'corsair', 'razer', 'redragon', 'acer', 'msi', 'sony', 
            'nintendo', 'playstation'
        ];

        $ignoredKeywords = [
            'rating:', 'review count:', 'opiniones', '[object object]', 
            'entrega rápida', 'marca:', 'ahorras', 'envío gratis', 'relative href',
            'h-full', 'sr-only', 'font-bold', 'text-content', 'inline-flex'
        ];

        foreach ($files as $file) {
            if (strtolower($file->getExtension()) !== 'csv') {
                continue;
            }

            $filename = $file->getFilename();

            // 1. Crear / Obtener la Categoría con su Slug
            $categoryName = Str::title(str_replace(['_', '-'], ' ', $file->getFilenameWithoutExtension()));
            $categoryNameClean = trim($categoryName);

            $category = Category::firstOrCreate(
                ['name' => $categoryNameClean],
                ['slug' => Str::slug($categoryNameClean)]
            );

            if ($this->command) {
                $this->command->info("📁 Procesando: {$filename} -> Categoría: '{$category->name}'");
            }

            // 2. Leer archivo y limpiar BOM UTF-8
            $content = file_get_contents($file->getPathname());
            $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
            $content = preg_replace('/^\xFF\xFE|\xFE\xFF/', '', $content);

            $lines = array_filter(explode("\n", str_replace(["\r\n", "\r"], "\n", $content)));

            if (empty($lines)) {
                continue;
            }

            $imported = 0;

            foreach ($lines as $lineIndex => $line) {
                $raw = trim($line);
                if (empty($raw)) continue;

                // OMITIR LA FILA DE ENCABEZADO (Índice 0 o filas con clases CSS)
                if ($lineIndex === 0 || str_contains(strtolower($raw), 'relative href') || str_contains(strtolower($raw), 'h-full src')) {
                    continue;
                }

                // Limpiar comillas envolventes externas y desescapar comillas dobles
                if (str_starts_with($raw, "'")) $raw = substr($raw, 1);
                if (str_ends_with($raw, "'")) $raw = substr($raw, 0, -1);
                if (str_starts_with($raw, '"') && str_ends_with($raw, '"')) $raw = substr($raw, 1, -1);

                $rawUnescaped = str_replace('""', '"', $raw);

                // Procesar la línea como CSV por comas
                $row = str_getcsv($rawUnescaped, ',');

                if (empty($row) || count($row) < 2) {
                    continue;
                }

                $imageUrl = null;
                $brand    = "Bohemian's";
                $price    = 0.0;
                $candidates = [];

                foreach ($row as $col) {
                    $val = trim($col, " \t\n\r\0\x0B\"'");
                    if (empty($val)) continue;

                    // Extraer Imagen
                    if (filter_var($val, FILTER_VALIDATE_URL)) {
                        if (str_contains($val, 'kemikcdn') || preg_match('/\.(jpg|jpeg|png|webp|gif)/i', $val)) {
                            if (!$imageUrl) $imageUrl = $val;
                        }
                        continue;
                    }

                    // Extraer Precio en Quetzales
                    if (str_starts_with($val, 'Q') && strlen($val) > 1) {
                        $pStr = str_replace(',', '', substr($val, 1));
                        if (is_numeric($pStr) && floatval($pStr) > 0 && $price == 0.0) {
                            $price = floatval($pStr);
                            continue;
                        }
                    }

                    // Extraer Marca
                    if (in_array(strtolower($val), $knownBrands)) {
                        $brand = Str::title($val);
                        continue;
                    }

                    // Filtrar Candidatos para Nombre del Producto
                    $valLower = strtolower($val);
                    $isIgnored = false;
                    foreach ($ignoredKeywords as $ik) {
                        if (str_contains($valLower, $ik)) {
                            $isIgnored = true;
                            break;
                        }
                    }

                    if ($isIgnored) continue;
                    if (str_ends_with($valLower, '% off')) continue;
                    if (is_numeric($val) || (str_starts_with($val, '(') && str_ends_with($val, ')'))) continue;

                    $candidates[] = $val;
                }

                if (empty($candidates)) {
                    continue;
                }

                // Seleccionar la cadena descriptiva más larga como Título
                usort($candidates, fn($a, $b) => strlen($b) <=> strlen($a));
                $name = $candidates[0];

                if (strlen($name) < 4) {
                    continue;
                }

                $name = Str::limit($name, 200, '');

                if ($price <= 0) {
                    $price = 125.00;
                }

                if (empty($imageUrl)) {
                    $imageUrl = 'https://via.placeholder.com/300x300?text=' . urlencode(substr($name, 0, 25));
                }

                // Insertar Producto
                Product::create([
                    'name'          => $name,
                    'brand'         => $brand,
                    'price'         => $price,
                    'stock'         => rand(6, 30),
                    'category_id'   => $category->id,
                    'description'   => $name,
                    'image_url'     => $imageUrl,
                    'rating'        => 5.0,
                    'reviews_count' => rand(3, 25),
                ]);

                $imported++;
            }

            if ($this->command) {
                $this->command->info("  ✅ Insertados: {$imported} productos reales en '{$category->name}'");
            }
        }
    }
}