<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracaController extends Controller
{
    public function index()
    {
        $dari = "";
        $hingga = "";
        return view('pemilik.laporan.neraca', compact('dari', 'hingga'));
    }

    public function filter(Request $req)
    {
        $dari = $req->dari;
        $hingga = $req->hingga;
        $laporan = DB::select("SELECT tanggal, b.kode, b.nama, SUM(a.debit) debit, SUM(a.kredit) kredit FROM (
            SELECT tanggal, '1' AS 'akun_id', SUM(grand_total) AS debit, 0 kredit FROM transaksi_penjualan
            UNION ALL
            SELECT tanggal, '11' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_penjualan

            UNION ALL
            SELECT tanggal, '1' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_pembelian
            UNION ALL
            SELECT tanggal, '12' AS 'akun_id', SUM(grand_total) AS debit, 0 kredit FROM transaksi_pembelian

            UNION ALL
            SELECT tanggal, '1' AS 'akun_id', SUM(jumlah) AS debit, 0 kredit FROM transaksi_kas
            UNION ALL
            SELECT tanggal, akun_id, 0 AS debit, SUM(jumlah) kredit FROM transaksi_kas

            UNION ALL
            SELECT tanggal, '1' AS 'akun_id', 0 AS debit, SUM(jumlah) kredit FROM transaksi_biaya
            UNION ALL
            SELECT tanggal, akun_id, SUM(jumlah) AS debit, 0 kredit FROM transaksi_biaya

            ) AS a INNER JOIN akun AS b ON a.akun_id=b.id WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id", [$dari, $hingga]);
        return view('pemilik.laporan.neraca', compact('dari', 'hingga', 'laporan'));
    }
}
