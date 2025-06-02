<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sesion extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['usuario_id', 'agente', 'ip', 'ultima_actividad'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
