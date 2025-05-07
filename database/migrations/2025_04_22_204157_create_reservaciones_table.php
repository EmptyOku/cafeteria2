<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('mesa_id')->constrained('mesas')->onDelete('cascade');
            $table->date('fecha_reservacion');
            $table->time('hora_reservacion');
            $table->time('hora_fin');
            $table->integer('numero_comensales');
            $table->enum('estado', ['confirmada', 'cancelada', 'completada', 'no_show'])->default('confirmada');
            $table->text('solicitudes_especiales')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
};
