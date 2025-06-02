<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'mesa_id',
        'estado',
        'notas',
        'numero_pedido',
        'monto_total',
        'metodo_pago',
        'estado_pago',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function items()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
