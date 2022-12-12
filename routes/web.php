<?php

use App\Http\Controllers\BackupsController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', function () {
    return view('layouts/master');
})->middleware('auth');

Route::resource('empleado',EmpleadoController::class)->middleware('auth');

Route::resource('producto',ProductoController::class)->middleware('auth');

//-----------------CLIENTES-----------------//
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::get('clientes/{cliente}/canjear', [ClienteController::class, 'canjeo'])->name('clientes.canjeo')->middleware('auth');
Route::post('clientes/{cliente}/canjear', [ClienteController::class, 'canjear'])->name('clientes.canjear')->middleware('auth');
Route::put('clientes/{cliente}/premios/{premio}', [ClienteController::class, 'destroyPremio'])->name('clientes.destroyPremio')->middleware('auth');
//-----------------CLIENTES-----------------//


Route::resource('tanques', TanqueController::class)->middleware('auth');

Route::put('tanques/{tanque}/recargar', [TanqueController::class, 'recargar'])->name('tanques.recargar')->middleware('auth');

Route::put('tanques/{tanque}/llenar', [TanqueController::class, 'llenar'])->name('tanques.llenar')->middleware('auth');

Route::resource('premios', PremioController::class)->middleware('auth');

//Bitacora
Route::resource('bitacora', BitacoraController::class)->middleware('auth');
Route::get('backups/{name}/downloadFile',[BackupsController::class,'downloadFile'])->middleware('auth');
Route::resource('backups', BackupsController::class)->middleware('auth');


