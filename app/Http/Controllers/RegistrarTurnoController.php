<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;

class RegistrarTurnoController extends Controller
{
    public function marcarEntrada(Request $request)
    {
        $usuario_id = Auth::id();

        // Verifica si ya hay un turno abierto
        $turnoAbierto = Turno::where('usuario_id', $usuario_id)
            ->whereNull('hora_fin')
            ->first();

        if ($turnoAbierto) {
            return redirect()->back()->with('error', 'Ya tienes un turno abierto.');
        }

        Turno::create([
            'usuario_id' => $usuario_id,
            'hora_inicio' => now(),
            'notas' => 'Entrada automática',
        ]);

        return redirect()->back()->with('success', 'Entrada registrada exitosamente.');


    }

    public function marcarSalida(Request $request)
    {
        $usuario_id = Auth::id();

        $turno = Turno::where('usuario_id', $usuario_id)
            ->whereNull('hora_fin')
            ->first();

        if ($turno) {
            $turno->hora_fin = now();
            $turno->save();

            return redirect()->back()->with('success', 'Salida registrada exitosamente.');
        }

        return redirect()->back()->with('error', 'No se encontró un turno activo para el usuario.');
    }


}
