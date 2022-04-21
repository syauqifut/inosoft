<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\MobilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('motor/detail/{id}', [MotorController::class, 'showDetailMotor']);
Route::get('mobil/detail/{id}', [MobilController::class, 'showDetailMobil']);

Route::get('kendaraan', [KendaraanController::class, 'showIndex'])->name('kendaraan.index');
Route::get('kendaraan/create', [KendaraanController::class, 'showCreate'])->name('kendaraan.create');
Route::get('kendaraan/edit/{id}', [KendaraanController::class, 'showEdit']);

Route::get('motor', [MotorController::class, 'showIndex'])->name('motor.index');
Route::get('motor/create', [MotorController::class, 'showCreate'])->name('motor.create');
Route::get('motor/edit/{id}', [MotorController::class, 'showEdit']);

Route::get('mobil', [MobilController::class, 'showIndex'])->name('mobil.index');
Route::get('mobil/create', [MobilController::class, 'showCreate'])->name('mobil.create');
Route::get('mobil/edit/{id}', [MobilController::class, 'showEdit']);