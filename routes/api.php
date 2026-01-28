<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PerkuliahanController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('mahasiswa', MahasiswaController::class);
        Route::apiResource('krs', KrsController::class);
        Route::apiResource('dosen', DosenController::class);
        Route::apiResource('matakuliah', MatakuliahController::class);
        Route::apiResource('nilai', NilaiController::class);
        Route::apiResource('perkuliahan', PerkuliahanController::class);
        
    });
});
