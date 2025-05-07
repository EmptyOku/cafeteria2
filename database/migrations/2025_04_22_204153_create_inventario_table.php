<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->onDelete('set null');
            $table->string('producto'); // Cambiado de 'nombre' a 'producto'
            $table->text('descripcion')->nullable();
            $table->decimal('cantidad', 10, 2);
            $table->string('unidad', 50)->comment('kg, litros, unidades, etc.');
            $table->decimal('nivel_reorden', 10, 2)->nullable()->comment('Cantidad mínima para reabastecer');
            $table->decimal('costo_por_unidad', 10, 2)->nullable();
            $table->string('ubicacion_almacen', 100)->nullable()->comment('Estante, refrigerador, etc.');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventario');
    }
};
