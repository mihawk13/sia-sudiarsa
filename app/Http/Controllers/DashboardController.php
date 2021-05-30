<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $year = date('Y');
        $tahun = DB::select('SELECT DISTINCT YEAR(tanggal) tahun FROM (
            SELECT tanggal FROM transaksi_penjualan
            UNION ALL
            SELECT tanggal FROM transaksi_pembelian
            ) AS z ORDER BY tahun');
        return view('dashboard', compact('tahun', 'year'));
    }

    public function filter(Request $req)
    {
        $year = $req->tahun;
        $tahun = DB::select('SELECT DISTINCT YEAR(tanggal) tahun FROM (
            SELECT tanggal FROM transaksi_penjualan
            UNION ALL
            SELECT tanggal FROM transaksi_pembelian
            ) AS z');
        return view('dashboard', compact('tahun', 'year'));
    }

    public function grafik($tahun)
    {
        $data = [];
        $trans = DB::select('SELECT thn, bln, SUM(debit) a, SUM(kredit) b FROM (
            SELECT MONTH(tanggal) bln, YEAR(tanggal) thn, SUM(grand_total) AS debit, 0 kredit FROM transaksi_penjualan
            WHERE YEAR(tanggal) = ?
            GROUP BY thn,bln
            UNION ALL
            SELECT MONTH(tanggal) bln, YEAR(tanggal) thn, 0 AS debit, SUM(grand_total) kredit FROM transaksi_pembelian
            WHERE YEAR(tanggal) = ?
            GROUP BY thn,bln
            ) AS z GROUP BY thn,bln', [$tahun, $tahun]);

        for ($i = 1; $i <= 12; $i++) {
            $bln = $i;
            $a = 0;
            $b = 0;
            foreach ($trans as $trx) {
                if ($trx->bln == $bln) {
                    $bln = $trx->bln;
                    $a = $trx->a;
                    $b = $trx->b;
                }
            }
            array_push($data, [
                'bulan' => $bln,
                'a' => $a,
                'b' => $b,
            ]);
        }

        return response()->json($data, 200);
    }
}
