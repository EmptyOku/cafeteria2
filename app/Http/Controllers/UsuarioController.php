<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo|max:255',
            'contrasena' => 'required|string|min:8',
            'rol' => 'required|string|in:administrador,empleado,cliente',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:500',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
            'rol' => $request->rol,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Asignar rol de Spatie
        $usuario->assignRole($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(Usuario $usuario)
    {
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id . '|max:255',
            'contrasena' => 'nullable|string|min:8',
            'rol' => 'required|string|in:administrador,empleado,cliente',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:500',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => $request->contrasena ? Hash::make($request->contrasena) : $usuario->contrasena,
            'rol' => $request->rol,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Sincronizar rol de Spatie
        $usuario->syncRoles([$request->rol]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
