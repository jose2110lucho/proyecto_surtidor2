<?php

use App\Http\Controllers\TanqueController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BombaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::middleware('auth:sanctum')->group(function () {
    
    Route::delete('logout', [AuthController::class, 'logout']);
});

Route::apiResource('productos', ProductoController::class);
Route::apiResource('users', UserController::class);
Route::post('login', [AuthController::class, 'login']);

Route::get('tanques',[TanqueController::class, 'indexApi']);
//Route::apiResource('tanques', TanqueController::class);
Route::get('bombas',[BombaController::class, 'indexApi']);
