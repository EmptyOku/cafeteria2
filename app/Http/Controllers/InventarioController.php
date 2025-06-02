<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Proveedor;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventario::query();

        if ($request->filled('buscar')) {
            $query->where('producto', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('proveedor_id')) {
            $query->where('proveedor_id', $request->proveedor_id);
        }

        $inventarios = $query->paginate(10);
        $proveedores = \App\Models\Proveedor::orderBy('nombre')->get();

        return view('admin.inventarios.index', compact('inventarios', 'proveedores'));
    }

    public function create()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('admin.inventarios.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'cantidad' => 'required|numeric|min:0',
            'unidad' => 'required|string|max:50',
            'nivel_reorden' => 'nullable|numeric|min:0',
            'costo_por_unidad' => 'nullable|numeric|min:0',
            'ubicacion_almacen' => 'nullable|string|max:100',
            'proveedor_id' => 'nullable|exists:proveedores,id',
        ]);

        Inventario::create($request->all());

        return redirect()->route('admin.inventarios.index')
            ->with('success', 'Producto de inventario creado correctamente.');
    }

    public function show(Inventario $inventario)
    {
        return view('admin.inventarios.show', compact('inventario'));
    }

    public function edit(Inventario $inventario)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('admin.inventarios.edit', compact('inventario', 'proveedores'));
    }

    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'cantidad' => 'required|numeric|min:0',
            'unidad' => 'required|string|max:50',
            'nivel_reorden' => 'nullable|numeric|min:0',
            'costo_por_unidad' => 'nullable|numeric|min:0',
            'ubicacion_almacen' => 'nullable|string|max:100',
            'proveedor_id' => 'nullable|exists:proveedores,id',
        ]);

        $inventario->update($request->all());

        return redirect()->route('admin.inventarios.index')
            ->with('success', 'Producto de inventario actualizado correctamente.');
    }

    public function destroy(Inventario $inventario)
    {
        $inventario->delete();

        return redirect()->route('admin.inventarios.index')
            ->with('success', 'Producto de inventario eliminado correctamente.');
    }
}
