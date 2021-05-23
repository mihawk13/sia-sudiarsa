<?php

use App\Http\Controllers\Pemilik\AkunController;
use App\Http\Controllers\Pemilik\BarangController;
use App\Http\Controllers\Pemilik\KasController;
use App\Http\Controllers\Pemilik\KontakController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware(['pemilik', 'auth'])->prefix('pemilik')->group(function () {
    Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('kontak', [KontakController::class, 'store']);
    Route::put('kontak', [KontakController::class, 'update']);

    Route::get('akun', [AkunController::class, 'index'])->name('akun');
    Route::post('akun', [AkunController::class, 'store']);
    Route::put('akun', [AkunController::class, 'update']);

    Route::get('barang', [BarangController::class, 'index'])->name('barang');
    Route::post('barang', [BarangController::class, 'store']);
    Route::put('barang', [BarangController::class, 'update']);

    Route::get('kas', [KasController::class, 'index'])->name('kas');
    Route::post('kas', [KasController::class, 'store']);
    Route::put('kas', [KasController::class, 'update']);
});

Route::middleware(['karyawan', 'auth'])->prefix('karyawan')->group(function () {
    // Route::get('tabungan', [ControllersSiswaController::class, 'tabungan'])->name('siswa.tabungan');
    // Route::get('penarikan', [ControllersSiswaController::class, 'penarikan'])->name('siswa.penarikan');
});
