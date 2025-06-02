<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mesa extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['numero', 'capacidad', 'estado', 'ubicacion'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
