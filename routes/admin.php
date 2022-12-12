<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TanqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\HomeControllerAdmin;
use App\Http\Controllers\EmpleadoController;

Route::get('',[HomeControllerAdmin::class, 'index'])->name('admin.home');
Route::resource('user',EmpleadoController::class)->names('modulo_administrativo.empleado');

Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('clientes', ClienteController::class)->names('clientes');;

Route::resource('tanques', TanqueController::class);