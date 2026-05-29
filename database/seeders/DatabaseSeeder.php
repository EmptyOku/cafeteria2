<?php

namespace Database\Seeders;

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
    }
}
