<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class ReservarMesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();
        return view('cliente.reservas.index', compact('mesas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'fecha_reservacion' => 'required|date|after_or_equal:today',
            'hora_reservacion' => 'required',
            'hora_fin' => 'required|after:hora_reservacion',
            'numero_comensales' => 'required|integer|min:1',
        ]);

        Reserva::create([
            'usuario_id' => Auth::id(),
            'mesa_id' => $request->mesa_id,
            'fecha_reservacion' => $request->fecha_reservacion,
            'hora_reservacion' => $request->hora_reservacion,
            'hora_fin' => $request->hora_fin,
            'numero_comensales' => $request->numero_comensales,
            'estado' => 'confirmada',
            'solicitudes_especiales' => $request->solicitudes_especiales,
        ]);

        return redirect()->back()->with('success', '¡Reserva realizada con éxito!');
    }

    public function show()
    {
        $reservas = Reserva::where('usuario_id', Auth::id())
            ->with('mesa')
            ->orderByDesc('fecha_reservacion')
            ->get();

        return view('cliente.reservas.show', compact('reservas'));
    }
}
