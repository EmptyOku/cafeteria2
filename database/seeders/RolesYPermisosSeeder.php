<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        // Crear usuarios de prueba consistentes y asignarles roles
        $usuarios = [
            [
                'nombre' => 'Administrador Demo',
                'correo' => 'admin@example.com',
                'contrasena' => 'password',
                'rol' => 'administrador',
            ],
            [
                'nombre' => 'Empleado Demo',
                'correo' => 'empleado@example.com',
                'contrasena' => 'password',
                'rol' => 'empleado',
            ],
            [
                'nombre' => 'Cliente Demo',
                'correo' => 'cliente@example.com',
                'contrasena' => 'password',
                'rol' => 'cliente',
            ],
        ];

        foreach ($usuarios as $datos) {
            $usuario = Usuario::updateOrCreate(
                ['correo' => $datos['correo']],
                [
                    'nombre' => $datos['nombre'],
                    'contrasena' => Hash::make($datos['contrasena']),
                    'rol' => $datos['rol'],
                ]
            );

            $usuario->syncRoles([$datos['rol']]);
        }
    }
}
