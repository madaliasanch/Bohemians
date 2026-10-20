<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductImporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        @ini_set('auto_detect_line_endings', true);

        $path = database_path('seeders');
        $files = File::files($path);
        $csvFilesFound = false;

        foreach ($files as $file) {
            if (strtolower($file->getExtension()) !== 'csv') {
                continue;
            }

            $csvFilesFound = true;
            $filename = $file->getFilename();

            // 1. Crear / Obtener la Categoría
            $categoryName = Str::title(str_replace(['_', '-'], ' ', $file->getFilenameWithoutExtension()));
            $category = Category::firstOrCreate(['name' => $categoryName]);

            if ($this->command) {
                $this->command->info("📁 Procesando CSV: {$filename} (Categoría: {$category->name})");
            }

            // 2. Leer contenido y eliminar BOM de UTF-8 y UTF-16
            $content = file_get_contents($file->getPathname());
            $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
            $content = preg_replace('/^\xFF\xFE|\xFE\xFF/', '', $content);

            $lines = array_filter(explode("\n", str_replace(["\r\n", "\r"], "\n", $content)));

            if (empty($lines)) {
                if ($this->command) {
                    $this->command->warn("  ⚠️ El archivo está vacío.");
                }
                continue;
            }

            // 3. Detectar delimitador (, ; \t)
            $firstLine = reset($lines);
            $delimiters = [
                ';'  => substr_count($firstLine, ';'),
                ','  => substr_count($firstLine, ','),
                "\t" => substr_count($firstLine, "\t")
            ];
            arsort($delimiters);
            $delimiter = key($delimiters);

            // 4. Convertir líneas a filas CSV
            $rows = [];
            foreach ($lines as $line) {
                if (trim($line) === '') continue;
                $rows[] = str_getcsv($line, $delimiter);
            }

            if (empty($rows)) {
                continue;
            }

            // 5. Extraer y normalizar encabezados (sin acentos ni caracteres especiales)
            $rawHeaders = array_shift($rows);
            $headers = array_map(function($h) {
                return strtolower(trim(preg_replace('/[^a-zA-Z0-9_]/', '', Str::ascii($h))));
            }, $rawHeaders);

            if ($this->command) {
                $this->command->line("  Encabezados detectados: [" . implode(', ', $headers) . "]");
            }

            $importedCount = 0;

            foreach ($rows as $row) {
                if (empty($row) || (count($row) == 1 && empty($row[0]))) {
                    continue;
                }

                // Crear mapa de clave -> valor
                $data = [];
                foreach ($headers as $index => $key) {
                    if (isset($row[$index])) {
                        $data[$key] = trim($row[$index]);
                    }
                }

                // DETECTAR NOMBRE
                $name = $data['nombre'] ?? $data['name'] ?? $data['producto'] ?? $data['articulo'] ?? $data['item'] ?? $data['title'] ?? $data['titulo'] ?? $data['descripcion'] ?? null;
                if (!$name && isset($row[0]) && !empty(trim($row[0]))) {
                    $name = trim($row[0]); // Respaldo: usar primera columna
                }

                if (!$name) {
                    continue;
                }

                // DETECTAR MARCA
                $brand = $data['marca'] ?? $data['brand'] ?? $data['fabricante'] ?? null;
                if (!$brand) {
                    $brand = (isset($row[1]) && !is_numeric($row[1])) ? trim($row[1]) : 'Bohemian\'s';
                }

                // DETECTAR PRECIO
                $priceVal = $data['precio'] ?? $data['price'] ?? $data['costo'] ?? $data['val'] ?? null;
                if ($priceVal === null) {
                    foreach ($row as $colVal) {
                        $clean = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $colVal));
                        if (is_numeric($clean) && floatval($clean) > 0) {
                            $priceVal = $clean;
                            break;
                        }
                    }
                }
                $cleanPrice = preg_replace('/[^0-9.]/', '', str_replace(',', '.', (string)$priceVal));
                $price = floatval($cleanPrice);
                if ($price <= 0) {
                    $price = 150.00; // Precio de respaldo si no se detecta
                }

                // DETECTAR STOCK
                $stockVal = $data['stock'] ?? $data['existencias'] ?? $data['cantidad'] ?? $data['cant'] ?? null;
                $cleanStock = preg_replace('/[^0-9]/', '', (string)$stockVal);
                $stock = ($cleanStock !== '') ? intval($cleanStock) : rand(5, 25);

                // DETECTAR DESCRIPCIÓN E IMAGEN
                $description = $data['descripcion'] ?? $data['description'] ?? $data['detalle'] ?? null;
                $imageUrl    = $data['imagen'] ?? $data['image_url'] ?? $data['imagen_url'] ?? $data['img'] ?? null;

                if (empty($imageUrl) || !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                    $imageUrl = 'https://via.placeholder.com/300x300?text=' . urlencode($name);
                }

                // GUARDAR PRODUCTO EN BASE DE DATOS
                Product::create([
                    'name'          => $name,
                    'brand'         => $brand,
                    'price'         => $price,
                    'stock'         => $stock,
                    'category_id'   => $category->id,
                    'description'   => $description,
                    'image_url'     => $imageUrl,
                    'rating'        => 5.0,
                    'reviews_count' => rand(3, 20),
                ]);

                $importedCount++;
            }

            if ($this->command) {
                $this->command->info("  ✅ Se importaron {$importedCount} productos.");
            }
        }

        if (!$csvFilesFound && $this->command) {
            $this->command->error("⚠️ No se encontraron archivos .csv en la carpeta database/seeders/");
        }
    }
}