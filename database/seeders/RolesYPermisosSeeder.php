<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Usuario;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permisos = [
            'ver dashboard',
            'ver usuarios',
            'ver turnos',
            'ver mesas',
            'ver pedidos',
            'ver items de pedido',
            'ver productos',
            'ver inventario',
            'ver categorias',
            'ver proveedores',
            'ver gastos',
            'ver reservas',
            'ver recetas',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'administrador']);
        $mesero = Role::firstOrCreate(['name' => 'empleado']);
        $cliente = Role::firstOrCreate(['name' => 'cliente']);

        // Asignar todos los permisos solo al administrador
        $admin->syncPermissions($permisos);

        // Los otros roles NO reciben permisos de menú
        $mesero->syncPermissions([]);
        $cliente->syncPermissions([]);

        // Asignar rol a usuarios de prueba
        $usuarios_roles = [
            1 => 'administrador',
            38 => 'administrador',
            36 => 'empleado',
            39 => 'cliente',
        ];

        foreach ($usuarios_roles as $id => $rol) {
            $usuario = Usuario::find($id);
            if ($usuario) {
                $usuario->assignRole($rol);
            }
        }
    }
}
