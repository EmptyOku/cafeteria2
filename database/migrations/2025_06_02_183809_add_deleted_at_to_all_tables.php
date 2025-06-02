<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('productos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('usuarios', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('mesas', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('inventario', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('items_pedido', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('recetas', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('gastos', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Repite para cada tabla que desees
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('productos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
         Schema::table('mesas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('inventario', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('items_pedido', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('recetas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
         Schema::table('gastos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        // Repite para cada tabla que desees
    }
};
