<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Usuario;
use App\Http\Requests\StoreGastoRequest;
use App\Http\Requests\UpdateGastoRequest;
use App\Models\Inventario;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index()
    {
        $gastos = Gasto::paginate(10);
        return view('admin.gastos.index', compact('gastos'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $inventarios = Inventario::all();
        return view('admin.gastos.create', compact('usuarios', 'inventarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
            'comprobante' => 'nullable|string|max:255',
            'relacion_inventario' => 'nullable|exists:inventario,id',
        ]);

        Gasto::create($request->all());

        return redirect()->route('admin.gastos.index')
            ->with('success', 'Gasto creado correctamente');
    }

    public function show(Gasto $gasto)
    {
        return view('admin.gastos.show', compact('gasto'));
    }

    public function edit(Gasto $gasto)
    {
        $usuarios = Usuario::all();
        $inventarios = Inventario::all();
        return view('admin.gastos.edit', compact('gasto', 'usuarios', 'inventarios'));
    }

    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'monto' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string|max:255',
            'comprobante' => 'nullable|string|max:255',
            'relacion_inventario' => 'nullable|exists:inventario,id',
        ]);

        $gasto->update($request->all());

        return redirect()->route('admin.gastos.index')
            ->with('success', 'Gasto actualizado correctamente');
    }

    public function destroy(Gasto $gasto)
    {
        $gasto->delete();

        return redirect()->route('admin.gastos.index')
            ->with('success', 'Gasto eliminado correctamente');
    }
}
