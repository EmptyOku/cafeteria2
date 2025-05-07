<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'hora_inicio', 'hora_fin', 'notas'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
