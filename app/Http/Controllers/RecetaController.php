<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Producto;
use App\Models\Inventario;
use App\Http\Requests\StoreRecetaRequest;
use App\Http\Requests\UpdateRecetaRequest;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    // WEB: Listado de recetas
    public function index()
    {
        $recetas = Receta::paginate(10); // Cambia all() por paginate()
        return view('admin.recetas.index', compact('recetas'));
    }

    // WEB: Formulario de creación
    public function create()
    {
        $productos = Producto::all();
        $insumos = Inventario::all();
        return view('admin.recetas.create', compact('productos', 'insumos'));
    }

    // WEB: Guardar nueva receta
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'insumo_id' => 'required|exists:inventario,id',
            'cantidad' => 'required|numeric|min:0',
            'instrucciones' => 'nullable|string|max:500',
        ]);

        Receta::create($request->all());

        return redirect()->route('admin.recetas.index')
            ->with('success', 'Receta creada correctamente');
    }

    // WEB: Mostrar detalle de receta
    public function show(Receta $receta)
    {
        return view('admin.recetas.show', compact('receta'));
    }

    // WEB: Formulario de edición
    public function edit(Receta $receta)
    {
        $productos = Producto::all();
        $insumos = Inventario::all();
        return view('admin.recetas.edit', compact('receta', 'productos', 'insumos'));
    }

    // WEB: Actualizar receta
    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'insumo_id' => 'required|exists:inventario,id',
            'cantidad' => 'required|numeric|min:0',
            'instrucciones' => 'nullable|string|max:500',
        ]);

        $receta->update($request->all());

        return redirect()->route('admin.recetas.index')
            ->with('success', 'Receta actualizada correctamente');
    }

    // WEB: Eliminar receta
    public function destroy(Receta $receta)
    {
        $receta->delete();

        return redirect()->route('admin.recetas.index')
            ->with('success', 'Receta eliminada correctamente');
    }
}
