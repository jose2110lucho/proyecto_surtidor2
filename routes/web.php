<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use App\Http\Controllers\BombaController;
use App\Http\Controllers\CombustibleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VehiculoController;
use App\Models\Premio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Auth::routes();
Route::get('/', function () {
    return view('layouts/master');
})->middleware('auth');


Route::resource('empleado',EmpleadoController::class);
Route::resource('producto',ProductoController::class);

//-----------------CLIENTES-----------------//
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::get('clientes/{cliente}/canjear', [ClienteController::class, 'canjeo'])->name('clientes.canjeo');
Route::patch('clientes/{cliente}/canjear', [ClienteController::class, 'canjear'])->name('clientes.canjear');
Route::delete('clientes/{cliente}/premios/{premio}', [ClienteController::class, 'destroyPremio'])->name('clientes.destroyPremio');
Route::post('clientes/{cliente}/vehiculos', [ClienteController::class, 'storeVehiculo'])->name('clientes.vehiculos.store');
//-----------------CLIENTES-----------------//

//-----------------TANQUES-----------------//
Route::resource('tanques', TanqueController::class)->middleware('auth');
Route::put('tanques/{tanque}/recargar', [TanqueController::class, 'recargar'])->name('tanques.recargar');
Route::put('tanques/{tanque}/llenar', [TanqueController::class, 'llenar'])->name('tanques.llenar');
//-----------------TANQUES-----------------//


///////BOMBA////
Route::resource('bombas', BombaController::class);
Route::resource('combustibles', CombustibleController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('cargas', CargaController::class);
Route::resource('pedidos', PedidoController::class);


//-----------------PREMIOS-----------------//
Route::resource('premios', PremioController::class)->middleware('auth');
//-----------------VEHICULOS-----------------//
Route::resource('vehiculos', VehiculoController::class);

