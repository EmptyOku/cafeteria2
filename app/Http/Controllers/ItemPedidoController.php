<?php

namespace App\Http\Controllers;


use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;


class ItemPedidoController extends Controller
{

    public function index()
    {
        $itemsPedido = ItemPedido::paginate(10);
        return view('admin.item_pedidos.index', compact('itemsPedido'));
    }


    public function create()
    {
        $pedidos = Pedido::all();
        $productos = Producto::all();
        return view('admin.item_pedidos.create', compact('pedidos', 'productos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['precio_total'] = $data['cantidad'] * $data['precio_unitario'];

        $itemPedido = ItemPedido::create($data);

        return redirect()->route('admin.item_pedidos.index')
            ->with('success', 'Ítem de pedido creado correctamente');
    }


    public function show(ItemPedido $itemPedido)
    {
        return view('admin.item_pedidos.show', compact('itemPedido'));
    }


    public function edit(ItemPedido $itemPedido)
    {
        $pedidos = Pedido::all();
        $productos = Producto::all();
        return view('admin.item_pedidos.edit', compact('itemPedido', 'pedidos', 'productos'));
    }


    public function update(Request $request, ItemPedido $itemPedido)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['precio_total'] = $data['cantidad'] * $data['precio_unitario'];

        $itemPedido->update($data);

        return redirect()->route('admin.item_pedidos.index')
            ->with('success', 'Ítem de pedido actualizado correctamente');
    }


    public function destroy(ItemPedido $itemPedido)
    {
        $itemPedido->delete();

        return redirect()->route('admin.item_pedidos.index')
            ->with('success', 'Ítem de pedido eliminado correctamente');
    }
}
