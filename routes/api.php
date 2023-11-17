<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route untuk menapilkan mahasisawa all
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pegawais', [PegawaiController::class, 'index']);
    Route::post('/pegawais', [PegawaiController::class, 'store']);
    Route::put('/pegawais/{id}', [PegawaiController::class, 'update']);
    Route::delete('/pegawais/{id}', [PegawaiController::class, 'destroy']);
    Route::get('/pegawais/{id}', [PegawaiController::class, 'show']);
});

// membuat route untuk registrasi dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
