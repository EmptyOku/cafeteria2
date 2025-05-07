<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ProductoController;

Route::apiResource('productos', ProductoController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('item_pedidos', ItemPedidoController::class);
Route::apiResource('inventarios', InventarioController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('mesas', MesaController::class);
Route::apiResource('proveedores', ProveedorController::class);
Route::apiResource('recetas', RecetaController::class);
Route::apiResource('reservas', ReservaController::class);
Route::apiResource('sesiones', SesionController::class);
Route::apiResource('turnos', TurnoController::class);
Route::apiResource('gastos', GastoController::class);

// Ruta personalizada de prueba
Route::get('/prueba', function () {
    return ['mensaje' => 'Todo funcionando perfecto 😎'];
});

// Ruta protegida con autenticación
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
