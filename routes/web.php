<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         Route::resource('categorias', CategoriaController::class);
         Route::resource('usuarios', UsuarioController::class);
         Route::resource('proveedores', ProveedorController::class)
             ->parameters(['proveedores' => 'proveedor']);
         Route::resource('turnos', TurnoController::class);
         Route::resource('inventarios', InventarioController::class);
         Route::resource('mesas', MesaController::class);
         Route::resource('productos', ProductoController::class);
         Route::resource('pedidos', PedidoController::class);
         Route::resource('reservas', ReservaController::class);
         Route::resource('recetas', RecetaController::class);
         Route::resource('item_pedidos', ItemPedidoController::class);
         Route::resource('gastos', GastoController::class);
         // … otras tablas
     });

require __DIR__.'/auth.php';
