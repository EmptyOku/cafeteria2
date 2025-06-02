<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receta extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['producto_id', 'insumo_id', 'cantidad', 'instrucciones'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Inventario::class, 'insumo_id');
    }
}
