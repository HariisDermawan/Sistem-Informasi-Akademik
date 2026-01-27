<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'store'])->middleware(['guest'])->name('login');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth:sanctum')->name('logout');

