<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'mesa_id',
        'fecha_reservacion',
        'hora_reservacion',
        'hora_fin',
        'numero_comensales',
        'estado',
        'solicitudes_especiales',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }
}
