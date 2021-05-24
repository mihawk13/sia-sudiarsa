<?php

use App\Http\Controllers\Pemilik\AkunController;
use App\Http\Controllers\Pemilik\BarangController;
use App\Http\Controllers\Pemilik\BiayaController;
use App\Http\Controllers\Pemilik\KasController;
use App\Http\Controllers\Pemilik\KontakController;
use App\Http\Controllers\Pemilik\PembelianController;
use App\Http\Controllers\Pemilik\PenjualanController;
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

    Route::get('biaya', [BiayaController::class, 'index'])->name('biaya');
    Route::post('biaya', [BiayaController::class, 'store']);
    Route::put('biaya', [BiayaController::class, 'update']);

    Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::post('penjualan', [PenjualanController::class, 'hapus']);
    Route::get('penjualan/tambah', [PenjualanController::class, 'create'])->name('penjualan.tambah');
    Route::post('penjualan/tambah', [PenjualanController::class, 'store']);
    Route::put('penjualan/tambah', [PenjualanController::class, 'simpan']);
    Route::delete('penjualan/tambah/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.hapus');
    Route::get('penjualan/tambah/{id}', [PenjualanController::class, 'batal'])->name('penjualan.batal');

    Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian');
    Route::post('pembelian', [PembelianController::class, 'hapus']);
    Route::get('pembelian/tambah', [PembelianController::class, 'create'])->name('pembelian.tambah');
    Route::post('pembelian/tambah', [PembelianController::class, 'store']);
    Route::put('pembelian/tambah', [PembelianController::class, 'simpan']);
    Route::delete('pembelian/tambah/{id}', [PembelianController::class, 'destroy'])->name('pembelian.hapus');
    Route::get('pembelian/tambah/{id}', [PembelianController::class, 'batal'])->name('pembelian.batal');

});

Route::middleware(['karyawan', 'auth'])->prefix('karyawan')->group(function () {
    // Route::get('tabungan', [ControllersSiswaController::class, 'tabungan'])->name('siswa.tabungan');
    // Route::get('penarikan', [ControllersSiswaController::class, 'penarikan'])->name('siswa.penarikan');
});
