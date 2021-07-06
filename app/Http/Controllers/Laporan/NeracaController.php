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
            SELECT tanggal, '1' AS 'akun_id', SUM(b.total-(c.harga_pokok*b.jumlah)) debit, 0 kredit FROM transaksi_penjualan a
            INNER JOIN transaksi_penjualan_detail b ON a.id=b.penjualan_id
            INNER JOIN barang c ON b.barang_id=c.id
            GROUP BY b.barang_id
            UNION ALL
            SELECT tanggal, '11' AS 'akun_id', 0 AS debit, SUM(b.total-(c.harga_pokok*b.jumlah)) kredit FROM transaksi_penjualan a
            INNER JOIN transaksi_penjualan_detail b ON a.id=b.penjualan_id
            INNER JOIN barang c ON b.barang_id=c.id
            GROUP BY b.barang_id

            UNION ALL
            SELECT * FROM (SELECT tanggal, '1' AS 'akun_id', 0 AS debit, SUM(grand_total) kredit FROM transaksi_pembelian
            UNION ALL
            SELECT tanggal, '12' AS 'akun_id', SUM(grand_total) AS debit, 0 kredit FROM transaksi_pembelian) AS z GROUP BY akun_id

            UNION ALL
            SELECT tanggal, '1' AS 'akun_id', SUM(jumlah) AS debit, 0 kredit FROM transaksi_kas
            UNION ALL
            SELECT tanggal, akun_id, 0 AS debit, SUM(jumlah) kredit FROM transaksi_kas

            UNION ALL
            SELECT tanggal, '1' AS 'akun_id', 0 AS debit, SUM(jumlah) kredit FROM transaksi_biaya WHERE tanggal BETWEEN '$dari' AND '$hingga' GROUP BY tanggal
            UNION ALL
            SELECT tanggal, akun_id, SUM(jumlah) AS debit, 0 kredit FROM transaksi_biaya WHERE tanggal BETWEEN '$dari' AND '$hingga' GROUP BY akun_id

            UNION ALL
            SELECT tanggal, akun_id, IF(SUM(ke-dari)>0,SUM(ke-dari),0) AS debit, REPLACE(IF(SUM(ke-dari)<0,SUM(ke-dari),0),'-','') AS kredit FROM (

            SELECT tanggal, dari AS 'akun_id', SUM(jumlah) AS dari, 0 AS ke FROM perpindahan_dana GROUP BY akun_id,tanggal
            UNION ALL
            SELECT tanggal, ke AS 'akun_id', 0 AS dari, SUM(jumlah) AS ke FROM perpindahan_dana GROUP BY akun_id,tanggal

            ) AS a INNER JOIN akun AS b ON a.akun_id=b.id
            WHERE tanggal BETWEEN '$dari' AND '$hingga'
            GROUP BY a.akun_id

            ) AS a INNER JOIN akun AS b ON a.akun_id=b.id WHERE a.tanggal BETWEEN ? AND ? GROUP BY a.akun_id ORDER BY kode", [$dari, $hingga]);
        return view('pemilik.laporan.neraca', compact('dari', 'hingga', 'laporan'));
    }
}
