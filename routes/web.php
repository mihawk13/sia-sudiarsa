<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Laporan\CALKController;
use App\Http\Controllers\Laporan\LabaRugiController;
use App\Http\Controllers\Laporan\NeracaController;
use App\Http\Controllers\Laporan\PDF_CALKController;
use App\Http\Controllers\Laporan\PDF_LabaRugiController;
use App\Http\Controllers\Laporan\PDF_NeracaController;
use App\Http\Controllers\Laporan\PDF_PersediaanController;
use App\Http\Controllers\Laporan\PersediaanBarangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
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

Route::get('/grafik/{tahun}', [DashboardController::class, 'grafik'])->middleware(['auth'])->name('grafik');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'filter'])->middleware(['auth']);

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

    Route::get('laporan/neraca', [NeracaController::class, 'index'])->name('lap.neraca');
    Route::post('laporan/neraca', [NeracaController::class, 'filter']);
    Route::get('laporan/neraca/{dari}/{hingga}', [PDF_NeracaController::class, 'cetak'])->name('lap.neraca.cetak');

    Route::get('laporan/labarugi', [LabaRugiController::class, 'index'])->name('lap.labarugi');
    Route::post('laporan/labarugi', [LabaRugiController::class, 'filter']);
    Route::get('laporan/labarugi/{dari}/{hingga}', [PDF_LabaRugiController::class, 'cetak'])->name('lap.labarugi.cetak');

    Route::get('laporan/calk', [CALKController::class, 'index'])->name('lap.calk');
    Route::post('laporan/calk', [CALKController::class, 'filter']);
    Route::get('laporan/calk/{dari}/{hingga}', [PDF_CALKController::class, 'cetak'])->name('lap.calk.cetak');

    Route::get('laporan/persediaan', [PersediaanBarangController::class, 'index'])->name('lap.persediaan');
    Route::post('laporan/persediaan', [PersediaanBarangController::class, 'filter']);
    Route::get('laporan/persediaan/{dari}/{hingga}', [PDF_PersediaanController::class, 'cetak'])->name('lap.persediaan.cetak');
});

Route::middleware(['karyawan', 'auth'])->prefix('karyawan')->group(function () {
    Route::get('kontak', [KontakController::class, 'index'])->name('karyawan.kontak');
    Route::post('kontak', [KontakController::class, 'store']);
    Route::put('kontak', [KontakController::class, 'update']);

    Route::get('barang', [BarangController::class, 'index'])->name('karyawan.barang');
    Route::post('barang', [BarangController::class, 'store']);
    Route::put('barang', [BarangController::class, 'update']);

    Route::get('kas', [KasController::class, 'index'])->name('karyawan.kas');
    Route::post('kas', [KasController::class, 'store']);
    Route::put('kas', [KasController::class, 'update']);

    Route::get('biaya', [BiayaController::class, 'index'])->name('karyawan.biaya');
    Route::post('biaya', [BiayaController::class, 'store']);
    Route::put('biaya', [BiayaController::class, 'update']);

    Route::get('penjualan', [PenjualanController::class, 'index'])->name('karyawan.penjualan');
    Route::post('penjualan', [PenjualanController::class, 'hapus']);
    Route::get('penjualan/tambah', [PenjualanController::class, 'create'])->name('karyawan.penjualan.tambah');
    Route::post('penjualan/tambah', [PenjualanController::class, 'store']);
    Route::put('penjualan/tambah', [PenjualanController::class, 'simpan']);
    Route::delete('penjualan/tambah/{id}', [PenjualanController::class, 'destroy'])->name('karyawan.penjualan.hapus');
    Route::get('penjualan/tambah/{id}', [PenjualanController::class, 'batal'])->name('karyawan.penjualan.batal');

    Route::get('pembelian', [PembelianController::class, 'index'])->name('karyawan.pembelian');
    Route::post('pembelian', [PembelianController::class, 'hapus']);
    Route::get('pembelian/tambah', [PembelianController::class, 'create'])->name('karyawan.pembelian.tambah');
    Route::post('pembelian/tambah', [PembelianController::class, 'store']);
    Route::put('pembelian/tambah', [PembelianController::class, 'simpan']);
    Route::delete('pembelian/tambah/{id}', [PembelianController::class, 'destroy'])->name('karyawan.pembelian.hapus');
    Route::get('pembelian/tambah/{id}', [PembelianController::class, 'batal'])->name('karyawan.pembelian.batal');
});
