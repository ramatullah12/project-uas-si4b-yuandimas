<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PemesananController;
use App\Http\Controllers\API\RuteController;
use App\Http\Controllers\TransportasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('category', [CategoryController::class, 'index']);
Route::get('pemesanan',[PemesananController::class, 'index']);
Route::get('rute',[RuteController::class, 'index']);
Route::get('transportasi',[TransportasiController::class, 'index']);

Route::post('category', [CategoryController::class, 'store']);
Route::post('pemesanan', [PemesananController::class, 'store']);
Route::post('rute', [RuteController::class, 'store']);
Route::post('transportasi', [TransportasiController::class, 'store']);

Route::put('category/{id}', [CategoryController::class, 'update']);
Route::put('pemesanan/{id}', [PemesananController::class, 'update']);
Route::put('rute/{id}', [RuteController::class, 'update']);
Route::put('transportasi/{id}', [TransportasiController::class, 'update']);

Route::delete('category/{id}', [CategoryController::class, 'destroy']);
Route::delete('pemesanan/{id}', [PemesananController::class, 'destroy']);
Route::delete('rute/{id}', [RuteController::class, 'destroy']);
Route::delete('transportasi/{id}', [TransportasiController::class, 'destroy']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);