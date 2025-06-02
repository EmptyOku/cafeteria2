<?php

namespace App\Http\Controllers;


use App\Models\Reserva;
use App\Models\Mesa;
use App\Models\Usuario;
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    // WEB: Listado de reservas
    public function index()
    {
        $hoy = Carbon::today();
        $ahora = Carbon::now();

        // Reservas de hoy, no vencidas
        $reservasHoy = Reserva::whereDate('fecha_reservacion', $hoy)
            ->where('hora_fin', '>=', $ahora->format('H:i'))
            ->orderBy('hora_reservacion')
            ->get();

        // Reservas de hoy, ya vencidas
        $reservasVencidas = Reserva::whereDate('fecha_reservacion', $hoy)
            ->where('hora_fin', '<', $ahora->format('H:i'))
            ->orderBy('hora_reservacion')
            ->get();

        // Reservas de días pasados
        $reservasPasadas = Reserva::whereDate('fecha_reservacion', '<', $hoy)
            ->orderBy('fecha_reservacion', 'desc')
            ->orderBy('hora_reservacion', 'desc')
            ->get();

        return view('admin.reservas.index', compact('reservasHoy', 'reservasVencidas', 'reservasPasadas'));
    }

    // WEB: Formulario de creación
    public function create()
    {
        $mesas = Mesa::all();
        $usuarios = Usuario::all();
        return view('admin.reservas.create', compact('mesas', 'usuarios'));
    }

    // WEB: Guardar nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'mesa_id' => 'required|exists:mesas,id',
            'fecha_reservacion' => 'required|date',
            'hora_reservacion' => 'required|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i|after:hora_reservacion',
            'numero_comensales' => 'required|integer|min:1',
            'estado' => 'required|string|in:pendiente,confirmada,cancelada',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        Reserva::create($request->all());

        return redirect()->route('admin.reservas.index')
            ->with('success', 'Reserva creada correctamente');
    }

    // WEB: Mostrar detalle de reserva
    public function show(Reserva $reserva)
    {
        return view('admin.reservas.show', compact('reserva'));
    }

    // WEB: Formulario de edición
    public function edit(Reserva $reserva)
    {
        $mesas = Mesa::all();
        $usuarios = Usuario::all();
        return view('admin.reservas.edit', compact('reserva', 'mesas', 'usuarios'));
    }

    // WEB: Actualizar reserva
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'mesa_id' => 'required|exists:mesas,id',
            'fecha_reservacion' => 'required|date',
            'hora_reservacion' => 'required|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i|after:hora_reservacion',
            'numero_comensales' => 'required|integer|min:1',
            'estado' => 'required|string|in:pendiente,confirmada,cancelada',
            'solicitudes_especiales' => 'nullable|string|max:255',
        ]);

        $reserva->update($request->all());

        return redirect()->route('admin.reservas.index')
            ->with('success', 'Reserva actualizada correctamente');
    }

    // WEB: Eliminar reserva
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return redirect()->route('admin.reservas.index')
            ->with('success', 'Reserva eliminada correctamente');
    }
}
