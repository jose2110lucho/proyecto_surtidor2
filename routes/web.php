<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use App\Http\Controllers\BombaController;
use App\Http\Controllers\CombustibleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clientes', ClienteController::class);

Route::resource('tanques', TanqueController::class);



///////BOMBA////
Route::resource('bombas', BombaController::class);
Route::resource('combustibles', CombustibleController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('cargas', CargaController::class);
Route::resource('pedidos', PedidoController::class);

//Route::get('bombas/index', [App\Http\Controllers\BombaController::class, 'index'])->name('pages.bombas.index');
//Route::get('pages/bombas/index', [App\Http\Controllers\BombaController::class, 'index'])->name('pages.bombas.index');
//Route::get('bombas/create', [App\Http\Controllers\BombaController::class, 'create'])->name('pages.bombas.create');
//x|Route::post('bombas/create', [BombaController::class, 'store'])->name('bombas.create');
//Route::get('bombas/edit/{id}',[App\Http\Controllers\BombaController::class, 'edit'])->name('pages.bombas.edit');

//Route::patch('pages/bombas/edit/{id}',[App\Http\Controllers\BombaController::class, 'edit'])->name('pages.bombas.edit' );



