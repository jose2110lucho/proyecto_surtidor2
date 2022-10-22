<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\ProductoController;
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

Route::resource('clientes', ClienteController::class)->middleware('auth');

Route::resource('tanques', TanqueController::class)->middleware('auth');


Route::resource('premios', PremioController::class)->middleware('auth');
