<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MotorController;
use Illuminate\Http\Request;
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

Route::get('/dashboard', [DashboardController::class, 'stok']);


Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::post('/kendaraan', [KendaraanController::class, 'store']);
Route::get('/kendaraan/{id}', [KendaraanController::class, 'show']);
Route::put('/kendaraan/{id}', [KendaraanController::class, 'update']);
Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy']);

Route::get('/mobil', [MobilController::class, 'index']);
Route::get('/mobilsold', [MobilController::class, 'sold']);
Route::post('/mobil', [MobilController::class, 'store']);
Route::get('/mobil/{id}', [MobilController::class, 'show']);
Route::put('/mobil/{id}', [MobilController::class, 'update']);
Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);
Route::put('/mobil/status/{id}', [MobilController::class, 'status']);

Route::get('/motor', [MotorController::class, 'index']);
Route::get('/motorsold', [MotorController::class, 'sold']);
Route::post('/motor', [MotorController::class, 'store']);
Route::get('/motor/{id}', [MotorController::class, 'show']);
Route::put('/motor/{id}', [MotorController::class, 'update']);
Route::delete('/motor/{id}', [MotorController::class, 'destroy']);
Route::put('/motor/status/{id}', [MotorController::class, 'status']);
