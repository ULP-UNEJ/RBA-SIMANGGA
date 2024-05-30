<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PeranHakAksesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Setelan
    Route::prefix('setelan')->name('setelan.')->group(function () {
        Route::get('peran-hak-akses', [PeranHakAksesController::class, 'index'])->name('peran-hak-akses.index');
        Route::get('peran-hak-akses/{id}', [PeranHakAksesController::class, 'show'])->name('peran-hak-akses.show');
        Route::post('peran-hak-akses', [PeranHakAksesController::class, 'store'])->name('peran-hak-akses.store');
        Route::put('peran-hak-akses/{id}', [PeranHakAksesController::class, 'update'])->name('peran-hak-akses.update');
        Route::delete('peran-hak-akses/{role}', [PeranHakAksesController::class, 'destroy'])->name('peran-hak-akses.destroy');
    });

    // Fakultas
    Route::prefix('fakultas')->name('fakultas.')->group(function () {
        // Profil Fakultas
        Route::get('/profil', [FakultasController::class, 'index'])->name('profil.index');
    });

    // Master Data
    Route::prefix('master-data')->name('master-data.')->group(function () {
        // Pengguna
        Route::get('pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::get('pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('pengguna/{user}', [PenggunaController::class, 'show'])->name('pengguna.show');
        Route::get('pengguna/{user}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('pengguna/{user}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('pengguna/{user}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });
});
