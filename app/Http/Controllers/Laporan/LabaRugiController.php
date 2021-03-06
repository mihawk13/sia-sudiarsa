<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabaRugiController extends Controller
{
    public function index()
    {
        $dari = "";
        $hingga = "";
        return view('pemilik.laporan.labarugi', compact('dari', 'hingga'));
    }

    public function filter(Request $req)
    {
        $dari = $req->dari;
        $hingga = $req->hingga;
        $pemasukan = DB::select("SELECT tanggal, b.kode, b.nama, SUM(a.kredit) jumlah FROM (
            SELECT tanggal, '11' AS 'akun_id', 0 AS debit, SUM(b.total-(c.harga_pokok*b.jumlah)) kredit,c.nama FROM transaksi_penjualan a
            INNER JOIN transaksi_penjualan_detail b ON a.id=b.penjualan_id
            INNER JOIN barang c ON b.barang_id=c.id
            GROUP BY b.barang_id
            ) AS a
            INNER JOIN akun AS b ON a.akun_id=b.id
            WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        $beban = DB::select("SELECT tanggal, akun_id, b.nama, SUM(jumlah) AS jumlah FROM transaksi_biaya AS a
                                INNER JOIN akun AS b ON a.akun_id=b.id
                                WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        return view('pemilik.laporan.labarugi', compact('dari', 'hingga', 'pemasukan', 'beban'));
    }
}
