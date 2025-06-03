<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class MenuClienteController extends Controller
{
    public function index()
    {
        // Solo productos activos y con inventario
        $productos = Producto::where('esta_activo', true)
                             ->where('inventario', '>', 0)
                             ->with('categoria') // solo relaciones reales
                             ->get();

        return view('cliente.menu', compact('productos'));
    }
}
