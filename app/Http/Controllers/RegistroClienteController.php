<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroClienteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo|max:255',
            'contrasena' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:500',
        ]);

        // Asigna el rol 'cliente' por defecto
        $rol = 'cliente';

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'rol' => $rol,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Asignar rol de Spatie si usas el paquete
        if (method_exists($usuario, 'assignRole')) {
            $usuario->assignRole($rol);
        }

        return redirect()->route('login')
            ->with('success', 'Usuario creado correctamente como cliente. Ahora puedes iniciar sesión.');
    }
}
