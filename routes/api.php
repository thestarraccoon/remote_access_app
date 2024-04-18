<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/add', [App\Http\Controllers\AddConnectionController::class, 'add']);
Route::put('/{id}', [App\Http\Controllers\AddConnectionController::class, 'update']);
Route::delete('/{id}', [App\Http\Controllers\AddConnectionController::class, 'delete']);
Route::get('/', [\App\Http\Controllers\API\ShowConnectionsController::class, 'index']);
Route::get('/search', [\App\Http\Controllers\API\ShowConnectionsController::class, 'getConnections']);
