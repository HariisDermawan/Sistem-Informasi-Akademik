<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PerkuliahanController;
use App\Http\Controllers\PresensiDosenController;
use App\Http\Controllers\PresensiMahasiswaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.auth');
})->middleware('guest')->name('login.form');

Route::post('/login', [AuthController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum')->name('dashboard');

Route::resources([
    'dosens' => DosenController::class,
    'mahasiswas' => MahasiswaController::class,
    'matkul' => MatakuliahController::class,
    'nilais' => NilaiController::class,
    'krss' => KrsController::class,
    'perkuliahans' => PerkuliahanController::class,
    'presensisdosens' => PresensiDosenController::class,
    'presensismahasiswas' => PresensiMahasiswaController::class,
    'prodis' => ProdiController::class,
    'semesters' => SemesterController::class,
]);
