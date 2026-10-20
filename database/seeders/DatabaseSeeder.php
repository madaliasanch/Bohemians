<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear / Restaurar Usuario Administrador
        User::firstOrCreate(
            ['email' => 'admin@bohemians.com'],
            [
                'name'              => 'Administrador Bohemian\'s',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
            ]
        );

        // 2. Crear / Restaurar Usuario Cliente Demo
        User::firstOrCreate(
            ['email' => 'cliente@bohemians.com'],
            [
                'name'              => 'Cliente Demo',
                'email_verified_at' => now(),
                'password'          => Hash::make('password123'),
            ]
        );

        // 3. Importar Categorías y Productos desde los archivos CSV
        $this->call([
            ProductImporterSeeder::class,
        ]);
    }
}