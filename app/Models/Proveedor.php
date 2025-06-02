<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{

    use HasFactory , SoftDeletes;

    protected $table = 'proveedores'; // 👈 Esto le dice a Laravel que no pluralice mal
    protected $fillable = ['nombre', 'contacto', 'telefono', 'correo', 'direccion'];

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
