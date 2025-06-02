<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecuta el seeder de roles y permisos primero
        $this->call([
            RolesYPermisosSeeder::class,
        ]);

        // Crea un usuario de prueba
        Usuario::create([
            'nombre' => 'Test User',
            'correo' => 'test@example.com',
            'contrasena' => bcrypt('password'),
            // agrega otros campos requeridos si es necesario
        ]);
    }
}
