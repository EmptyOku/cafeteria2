<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Mesa;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // WEB: Listado en vista
    public function index()
    {
        $pedidos = Pedido::all();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    // WEB: Formulario de creación
    public function create()
    {
        $mesas = Mesa::all();
        $usuarios = Usuario::all();
        return view('admin.pedidos.create', compact('mesas', 'usuarios'));
    }

    // WEB: Guardar nuevo pedido
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'mesa_id' => 'required|exists:mesas,id',
            'estado' => 'required|string|in:pendiente,preparando,completado,cancelado',
            'notas' => 'nullable|string|max:255',
            'monto_total' => 'required|numeric|min:0',
            'metodo_pago' => 'nullable|string|in:efectivo,tarjeta,transferencia,otro',
            'estado_pago' => 'nullable|string|in:pendiente,pagado,cancelado',
        ]);

        // Generar número de pedido automáticamente
        $ultimoPedido = Pedido::orderBy('id', 'desc')->first();
        $numeroPedido = $ultimoPedido ? $ultimoPedido->id + 1 : 1;

        Pedido::create([
            'usuario_id' => $request->usuario_id,
            'mesa_id' => $request->mesa_id,
            'estado' => $request->estado,
            'notas' => $request->notas,
            'numero_pedido' => $numeroPedido,
            'monto_total' => $request->monto_total,
            'metodo_pago' => $request->metodo_pago,
            'estado_pago' => $request->estado_pago,
        ]);

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido creado correctamente');
    }

    // WEB: Mostrar detalle
    public function show(Pedido $pedido)
    {
        return view('admin.pedidos.show', compact('pedido'));
    }

    // WEB: Formulario de edición
    public function edit(Pedido $pedido)
    {
        $mesas = Mesa::all();
        $usuarios = Usuario::all();
        return view('admin.pedidos.edit', compact('pedido', 'mesas', 'usuarios'));
    }

    // WEB: Actualizar pedido
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'mesa_id' => 'required|exists:mesas,id',
            'estado' => 'required|string|in:pendiente,completado,cancelado',
            'notas' => 'nullable|string|max:255',
            'monto_total' => 'required|numeric|min:0',
            'metodo_pago' => 'nullable|string|in:efectivo,tarjeta,transferencia,otro',
            'estado_pago' => 'nullable|string|in:pendiente,pagado,cancelado',
        ]);

        $pedido->update([
            'usuario_id' => $request->usuario_id,
            'mesa_id' => $request->mesa_id,
            'estado' => $request->estado,
            'notas' => $request->notas,
            'monto_total' => $request->monto_total,
            'metodo_pago' => $request->metodo_pago,
            'estado_pago' => $request->estado_pago,
        ]);

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido actualizado correctamente');
    }

    // WEB: Eliminar pedido
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido eliminado correctamente');
    }
}
