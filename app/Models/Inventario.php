<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'inventario';
    protected $fillable = [
        'producto',
        'descripcion',
        'cantidad',
        'unidad',
        'nivel_reorden',
        'costo_por_unidad',
        'ubicacion_almacen',
        'proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
