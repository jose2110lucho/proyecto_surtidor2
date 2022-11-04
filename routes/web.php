<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserTurnoController;


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

//-----------------EMPLEADO-----------------//
Route::resource('empleado',EmpleadoController::class);
//-----------------TURNO-----------------//
Route::resource('turno',TurnoController::class);
Route::get('turno/{turno}/add-user', [TurnoController::class, 'addUser'])->name('turno.addUser');
Route::post('turno/{turno}/add-user/', [TurnoController::class, 'storeUser'])->name('turno.storeUser');
Route::delete('turno/{turno}/destroy-user/{user_id}',[TurnoController::class, 'destroyUser'])->name('turno.destroyUser');
//-----------------EMPLEADO_TURNO-----------------//
Route::get('/user_turno/{id_turno}', [UserTurnoController::class, 'index'])->name('user_turno.index');
Route::get('/user_turno/create/{id_turno}', [UserTurnoController::class, 'create'])->name('user_turno.create');
Route::post('/user_turno/create/{id_turno}', [UserTurnoController::class, 'store'])->name('user_turno.store');
Route::delete('/user_turno/{id_turno}/delete/{id_empleadoturno}', [UserTurnoController::class, 'destroy'])->name('user_turno.destroy');
//-----------------PRODUCTO-----------------//
Route::resource('producto',ProductoController::class);
//-----------------PROVEEDORES-----------------//
Route::resource('proveedor', ProveedorController::class);
Route::get('/proveedor/{id}/desactivar', [ProveedorController::class, 'desactivar']);
Route::get('/proveedor/{id}/activar', [ProveedorController::class, 'activar']);
//-----------------CLIENTES-----------------//
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::get('clientes/{cliente}/canjear', [ClienteController::class, 'canjeo'])->name('clientes.canjeo');
Route::post('clientes/{cliente}/canjear', [ClienteController::class, 'canjear'])->name('clientes.canjear');
Route::put('clientes/{cliente}/premios/{premio}', [ClienteController::class, 'destroyPremio'])->name('clientes.destroyPremio');
//-----------------ASISTENCIA-----------------//
Route::get('asistencia', [AsistenciaController::class,'index'])->name('asistencia.index'); 
Route::get('asistencia/{turno}/create', [AsistenciaController::class,'create'])->name('asistencia.create'); 
Route::post('asistencia/{turno_id}/{user_id}/entrada', [AsistenciaController::class,'entrada'])->name('asistencia.entrada');
Route::put('asistencia/{turno_id}/{user_id}/salida', [AsistenciaController::class,'salida'])->name('asistencia.salida');
//-----------------TANQUES-----------------//
Route::resource('tanques', TanqueController::class)->middleware('auth');
Route::put('tanques/{tanque}/recargar', [TanqueController::class, 'recargar'])->name('tanques.recargar');
Route::put('tanques/{tanque}/llenar', [TanqueController::class, 'llenar'])->name('tanques.llenar');
//-----------------PREMIOS-----------------//
Route::resource('premios', PremioController::class)->middleware('auth');
//-----------------VEHICULOS-----------------//
Route::resource('vehiculos', VehiculoController::class);

