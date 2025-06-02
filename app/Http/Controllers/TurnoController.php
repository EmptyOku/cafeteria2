<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Http\Requests\StoreTurnoRequest;
use App\Http\Requests\UpdateTurnoRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;

class TurnoController extends Controller
{
    public function index()
    {
        $hoy = now()->toDateString();
        $turnosHoy = Turno::whereDate('created_at', $hoy)->get();
        $turnosAnteriores = Turno::whereDate('created_at', '<', $hoy)->paginate(5);
        return view('admin.turnos.index', compact('turnosHoy', 'turnosAnteriores'));
    }

    public function create()
    {
        $usuarios = Usuario::orderBy('nombre')->get();
        return view('admin.turnos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'notas' => 'nullable|string|max:255',
        ]);

        Turno::create($request->only('usuario_id', 'hora_inicio', 'hora_fin', 'notas'));

        return redirect()->route('admin.turnos.index')
            ->with('success', 'Turno creado correctamente.');
    }

    public function show(Turno $turno)
    {
        return view('admin.turnos.show', compact('turno'));
    }

    public function edit(Turno $turno)
    {
        $usuarios = \App\Models\Usuario::orderBy('nombre')->get();
        return view('admin.turnos.edit', compact('turno', 'usuarios'));
    }

    public function update(Request $request, Turno $turno)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'notas' => 'nullable|string|max:255',
        ]);

        $turno->update($request->only('usuario_id', 'hora_inicio', 'hora_fin', 'notas'));

        return redirect()->route('admin.turnos.index')
            ->with('success', 'Turno actualizado correctamente.');
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();

        return redirect()->route('admin.turnos.index')
            ->with('success', 'Turno eliminado correctamente.');
    }
}
