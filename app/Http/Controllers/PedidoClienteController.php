<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoClienteController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id();

        $pedidos = Pedido::with(['items.producto']) // Asegúrate de tener estas relaciones
                         ->where('usuario_id', $usuarioId)
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('cliente.pedidos', compact('pedidos'));
    }
}

