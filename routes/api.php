<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DesainApiController;
use Illuminate\Support\Facades\Route;

// Endpoint Autentikasi Publik
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Publik Read-Only (Katalog & Detail Desain)
Route::get('/desains', [DesainApiController::class, 'index']);
Route::get('/desains/{id}', [DesainApiController::class, 'show']);

// Endpoint Terproteksi Middleware Sanctum (Admin / Authenticated Actions)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/desains', [DesainApiController::class, 'index']);
    Route::get('/desains/{id}', [DesainApiController::class, 'show']);
    Route::post('/desains', [DesainApiController::class, 'store']);
    Route::post('/desains/{id}', [DesainApiController::class, 'update']); // Menggunakan POST untuk FormData multipart file upload
    Route::delete('/desains/{id}', [DesainApiController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
