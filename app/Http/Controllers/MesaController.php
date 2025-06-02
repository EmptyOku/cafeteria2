<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Http\Requests\StoreMesaRequest;
use App\Http\Requests\UpdateMesaRequest;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mesa::query();
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        $mesas = $query->paginate(10);
        return view('admin.mesas.index', compact('mesas'));
    }

    public function create()
    {
        return view('admin.mesas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|integer|unique:mesas,numero',
            'capacidad' => 'required|integer|min:1',
            'estado' => 'required|string|in:disponible,ocupada,reservada,mantenimiento',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        Mesa::create($request->all());

        return redirect()->route('admin.mesas.index')
            ->with('success', 'Mesa creada correctamente.');
    }

    public function show(Mesa $mesa)
    {
        return view('admin.mesas.show', compact('mesa'));
    }

    public function edit(Mesa $mesa)
    {
        return view('admin.mesas.edit', compact('mesa'));
    }

    public function update(Request $request, Mesa $mesa)
    {
        $request->validate([
            'numero' => 'required|integer|unique:mesas,numero,' . $mesa->id,
            'capacidad' => 'required|integer|min:1',
            'estado' => 'required|string|in:disponible,ocupada,reservada,mantenimiento',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        $mesa->update($request->all());

        return redirect()->route('admin.mesas.index')
            ->with('success', 'Mesa actualizada correctamente.');
    }

    public function destroy(Mesa $mesa)
    {
        $mesa->delete();

        return redirect()->route('admin.mesas.index')
            ->with('success', 'Mesa eliminada correctamente.');
    }
}
