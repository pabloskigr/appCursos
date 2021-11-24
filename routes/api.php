<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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

Route::prefix('usuario')->group(function(){
	Route::put('/crear',[UsuarioController::class, 'crear']);
	Route::post('/desactivar/{id}',[UsuarioController::class, 'desactivar']);
	Route::post('/editar/{id}',[UsuarioController::class, 'editar']);
	Route::get('/ver/{id}',[UsuarioController::class, 'ver']);
	Route::get('/lista',[UsuarioController::class, 'lista']);
});
