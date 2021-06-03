<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CALKController extends Controller // Catatan Atas Laporan Keuangan
{
    public function index()
    {
        $dari = "";
        $hingga = "";
        return view('pemilik.laporan.calk', compact('dari', 'hingga'));
    }

    public function filter(Request $req)
    {
        $dari = $req->dari;
        $hingga = $req->hingga;
        $pemasukan = DB::select("SELECT tanggal, b.kode, b.nama, SUM(a.jumlah) jumlah FROM (
            SELECT tanggal, '11' AS 'akun_id', SUM(grand_total) jumlah FROM transaksi_penjualan GROUP BY tanggal) AS a
            INNER JOIN akun AS b ON a.akun_id=b.id
            WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        $pembelian = DB::select("SELECT tanggal, b.kode, b.nama, SUM(a.jumlah) jumlah FROM (
            SELECT tanggal, '12' AS 'akun_id', SUM(grand_total) jumlah FROM transaksi_pembelian GROUP BY tanggal) AS a
            INNER JOIN akun AS b ON a.akun_id=b.id
            WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        $beban = DB::select("SELECT tanggal, akun_id, b.nama, SUM(jumlah) AS jumlah FROM transaksi_biaya AS a
                                INNER JOIN akun AS b ON a.akun_id=b.id
                                WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        return view('pemilik.laporan.calk', compact('dari', 'hingga', 'pemasukan', 'pembelian', 'beban'));
    }
}
