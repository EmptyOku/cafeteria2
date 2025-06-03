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
use App\Http\Controllers\MenuClienteController;
use App\Http\Controllers\PedidoClienteController;
use App\Http\Controllers\ReservarMesaController;
use App\Http\Controllers\RegistrarTurnoController;
use App\Http\Controllers\VerMesaController;
use App\Http\Controllers\RegistroClienteController;

Route::get('/', function () {
    return view('welcome');
});
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/pdf', [DashboardController::class, 'pdf'])->name('dashboard.pdf');
Route::get('/cliente/menu', [MenuClienteController::class, 'index'])->name('cliente.menu');
Route::get('/cliente/pedidos', [PedidoClienteController::class, 'index'])->name('cliente.pedidos');
Route::get('/cliente/reservas', [ReservarMesaController::class, 'index'])->name('cliente.reservas.index');
Route::post('/cliente/reservas', [ReservarMesaController::class, 'store'])->name('cliente.reservas.store');
Route::get('/cliente/reservas/mis-reservas', [ReservarMesaController::class, 'show'])->name('cliente.reservas.show');
Route::get('/empleado/mesas', [VerMesaController::class, 'index'])->name('mesas.estado');


Route::get('/cliente/home', function () {
    return view('cliente/home');
})->middleware(['auth', 'verified'])->name('cliente/home');
Route::get('/cliente/info', function () {
    return view('cliente/info');
})->middleware(['auth', 'verified'])->name('cliente/info');

Route::get('/empleado/home', function () {
    return view('empleado/home');
})->middleware(['auth', 'verified'])->name('empleado/home');

Route::get('welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

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

Route::post('/empleado/turnos/entrada', [RegistrarTurnoController::class, 'marcarEntrada'])->name('empleado.turnos.entrada');
Route::post('/empleado/turnos/salida', [RegistrarTurnoController::class, 'marcarSalida'])->name('empleado.turnos.salida');
Route::post('register', [RegistroClienteController::class, 'create'])->name('register');

require __DIR__.'/auth.php';
