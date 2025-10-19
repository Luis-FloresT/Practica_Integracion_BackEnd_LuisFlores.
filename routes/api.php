<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;

Route::post('/guardar-categoria', [CategoriaController::class, 'store']);
Route::get('/todas-las-categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show']);
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);

// Rutas de Productos
Route::post('/guardar-producto', [ProductoController::class, 'store']);
Route::get('/todos-los-productos', [ProductoController::class, 'index']);
Route::get('/productos/{producto}', [ProductoController::class, 'show']);
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy']);
Route::put('/productos/{producto}', [ProductoController::class, 'update']);

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
