<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\RutinasController;
use App\Http\Controllers\Api\AuthController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/clientes/{id}', [ClienteController::class, 'item']);
Route::get('/rutinas/list/', [RutinasController::class, 'list']);
Route::post('/rutinas/agregar/', [RutinasController::class, 'create']);
Route::post('/rutinas/eliminarlista/{id}', [RutinasController::class, 'destroy']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/rutinas/buscar/', [RutinasController::class, 'search']);
Route::get('/rutinas/{id}', [RutinasController::class, 'item']);
Route::post('/register', [AuthController::class, 'register']);