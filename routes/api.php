<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Api\JadwalLayananController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservasiController;
use App\Http\Controllers\Api\UserAuthController;

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

Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::post('/user/login', [UserAuthController::class, 'login']);

Route::middleware('web')->post('/user/login', [UserAuthController::class, 'login']);
