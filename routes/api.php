<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::controller(ProductoController::class)->group(function () {
    Route::get('/productos', 'index');
    Route::post('/productos', 'store');
    Route::get('/productos/{producto}', 'show');
    Route::put('/productos/{producto}', 'update');
    Route::delete('/productos/{producto}', 'destroy');
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error', 'message' => 'Ruta Incorrecta'
    ], 404);
});
