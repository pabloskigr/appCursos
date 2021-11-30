<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\VideoController;


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
Route::prefix('cursos')->group(function(){
	Route::put('/crear',[CursosController::class, 'crear']);
	Route::post('/editar/{id}',[CursosController::class, 'editar']);
	Route::get('/lista',[CursosController::class, 'lista']);
});
Route::prefix('video')->group(function(){
	Route::put('/crear',[VideoController::class, 'crear']);
	Route::get('/ver/{id}',[VideoController::class, 'ver']);
	Route::get('/lista',[VideoController::class, 'lista']);
});
