<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gasto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'monto',
        'descripcion',
        'categoria',
        'fecha',
        'comprobante',
        'relacion_inventario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'relacion_inventario');
    }
}
