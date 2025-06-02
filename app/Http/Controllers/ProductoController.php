<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ProductoController extends Controller
{

   public function index(Request $request)
    {
        $query = Producto::query();

        // Búsqueda por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Filtrado por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $productos = $query->paginate(10);
        $categorias = Categoria::orderBy('nombre')->get();

        // Alerta de productos bajos en inventario
        $alertaBajoInventario = Producto::where('inventario', '<=', 15)->get();

        return view('admin.productos.index', compact('productos', 'categorias', 'alertaBajoInventario'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'costo_base' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|string|max:255',
            'esta_activo' => 'nullable|boolean',
            'inventario' => 'nullable|integer|min:0',
        ]);

        Producto::create($request->all());

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'costo_base' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|string|max:255',
            'esta_activo' => 'nullable|boolean',
            'inventario' => 'nullable|integer|min:0',
        ]);

        $producto->update($request->all());

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
