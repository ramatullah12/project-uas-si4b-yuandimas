<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\TransportasiController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});
Route::get('about', function () {
    return "Halaman About";
});

Route::resource('category', CategoryController::class);
Route::resource('rute', RuteController::class);
Route::resource('transportasi', TransportasiController::class);
Route::resource('home', HomeController::class);
Route::resource('pemesanan', PemesananController::class);
Route::get('dashboard', [DashboardController::class, 'index']);

