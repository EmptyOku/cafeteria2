<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo Producto
 *
 * Representa los productos que pueden ser pedidos por los clientes.
 */
class Producto extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'costo_base',
        'imagen',
        'esta_activo',
        'inventario',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function itemsPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }
}
