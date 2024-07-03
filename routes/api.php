<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PemesananController;
use App\Http\Controllers\API\RuteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TransportasiController;
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

Route::middleware('auth:sanctum')->get('category', [CategoryController::class, 'index']);Route::post('category', [CategoryController::class, 'store']);
Route::patch('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);
Route::post('register', [AuthenticatedSessionController::class, 'register']);
Route::post('login', [AuthenticatedSessionController::class, 'login']);

Route::middleware('auth:sanctum')->get('rute', [RuteController::class, 'index']);Route::post('rute', [RuteController::class, 'store']);
Route::patch('rute/{id}', [RuteController::class, 'update']);
Route::delete('rute/{id}', [RuteController::class, 'destroy']);
Route::post('register', [AuthenticatedSessionController::class, 'register']);
Route::post('login', [AuthenticatedSessionController::class, 'login']);

Route::middleware('auth:sanctum')->get('transportasi', [TransportasiController::class, 'index']);Route::post('transportasi', [TransportasiController::class, 'store']);
Route::patch('transportasi/{id}', [TransportasiController::class, 'update']);
Route::delete('transportasi/{id}', [TransportasiController::class, 'destroy']);
Route::post('register', [AuthenticatedSessionController::class, 'register']);
Route::post('login', [AuthenticatedSessionController::class, 'login']);