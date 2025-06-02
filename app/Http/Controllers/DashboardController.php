<?php
namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Gasto;
use App\Models\ItemPedido;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Usuarios registrados este mes
        $usuariosMes = Usuario::whereMonth('created_at', now()->month)->count();

        // Total de productos activos
        $productosInventario = Producto::where('esta_activo', true)->count();

        // Ventas del día y del mes (por ItemsPedido)
        $ventasHoy = ItemPedido::whereDate('created_at', today())->sum('precio_total');
        $ventasMes = ItemPedido::whereMonth('created_at', now()->month)->sum('precio_total');

        // Productos por agotarse (stock <= 5)
        $productosBajos = Producto::where('inventario', '<=', 15)->get();

        // Inventario por agotarse (cantidad <= nivel_reorden)
        $inventariosBajos = Inventario::whereColumn('cantidad', '<=', 'nivel_reorden')->get();

        // Ventas de la semana (para gráfico)
        $ventasSemana = ItemPedido::selectRaw('DATE(created_at) as fecha, SUM(precio_total) as total')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->pluck('total', 'fecha')
            ->toArray();

        // Gastos de la semana (para gráfico)
        $gastosSemana = Gasto::selectRaw('DATE(fecha) as fecha, SUM(monto) as total')
            ->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->pluck('total', 'fecha')
            ->toArray();

        return view('dashboard', compact(
            'usuariosMes',
            'productosInventario',
            'ventasHoy',
            'ventasMes',
            'productosBajos',
            'inventariosBajos',
            'ventasSemana',
            'gastosSemana'
        ));
    }
}

