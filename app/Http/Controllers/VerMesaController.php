<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VerMesaController extends Controller
{

    public function index()
    {
        $hoy = Carbon::now()->toDateString();
        $horaActual = Carbon::now()->format('H:i');

        // Traer mesas con sus reservas del día confirmadas
        $mesas = Mesa::with(['reservas' => function ($query) use ($hoy) {
            $query->where('fecha_reservacion', $hoy)
                  ->where('estado', 'confirmada');
        }])->get();

        foreach ($mesas as $mesa) {
            $reservaActual = $mesa->reservas->first(function ($reserva) use ($horaActual) {
                return $horaActual >= $reserva->hora_reservacion &&
                      (is_null($reserva->hora_fin) || $horaActual < $reserva->hora_fin);
            });

            if ($reservaActual) {
                $mesa->estado_real = 'reservada';
            } else {
                $mesa->estado_real = 'disponible';
            }
        }

        return view('empleado.mesas', compact('mesas'));
    }
}


