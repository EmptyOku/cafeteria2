<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('insumo_id')->constrained('inventario')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2)->comment('Cantidad de insumo por unidad de producto');
            $table->text('instrucciones')->nullable()->comment('Detalles de preparación');
            $table->timestamps();

            $table->unique(['producto_id', 'insumo_id'], 'receta_unica');
        });
    }

    public function down()
    {
        Schema::dropIfExists('recetas');
    }
};
