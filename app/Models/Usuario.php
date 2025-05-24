<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory;

    /**
     * Atributos que pueden ser asignados masivamente.
     */
    protected $fillable = [
        'nombre',
        'correo',
        'correo_verificado_en',
        'contrasena',
        'rol',
        'telefono',
        'direccion'
    ];

     /**
     * Atributos que deben ser convertidos a tipo específico.
     */
    protected $casts = [
        'correo_verificado_en' => 'datetime',
    ];

    /**
     * Atributos ocultos para arrays.
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Relación uno a muchos: un usuario puede tener muchos pedidos.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Relación uno a muchos: un usuario puede tener muchas reservas.
     */
    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }

    /**
     * Relación uno a muchos: un usuario puede tener muchas sesiones.
     */
    public function sesiones()
    {
        return $this->hasMany(Sesion::class);
    }

    /**
     * Relación uno a muchos: un usuario puede registrar muchos turnos.
     */
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }

    /**
     * Relación uno a muchos: un usuario puede generar muchos gastos.
     */
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }

    public function getAuthPassword()
    {
    return $this->contrasena;
    }
}
