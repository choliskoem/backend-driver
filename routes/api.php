<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UndianController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RouletteController;
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

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::get('driver/{id}', [AuthController::class, 'drivers'])->middleware('auth:sanctum');
Route::get('hasildriver', [AuthController::class, 'hasildriver']);

Route::get('checkqr', [AuthController::class, 'checkqr']);
Route::post('addlogin', [App\Http\Controllers\Api\AuthController::class, 'store']);
Route::post('addscanner', [App\Http\Controllers\Api\AuthController::class, 'scanner'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/undian/nomor', [UndianController::class, 'getNomorUndianByUser']);

//post logout
Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->post('/pembelian', [UndianController::class, 'store']);
