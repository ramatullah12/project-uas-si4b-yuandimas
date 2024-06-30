<?php

use App\Http\Controllers\API\PemesananController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('pemesanan', [PemesananController::class, 'index']);Route::post('pemesanan', [PemesananController::class, 'store']);
Route::patch('pemesanan/{id}', [PemesananController::class, 'update']);
Route::delete('pemesanan/{id}', [PemesananController::class, 'destroy']);
Route::post('register', [AuthenticatedSessionController::class, 'register']);
Route::post('login', [AuthenticatedSessionController::class, 'login']);