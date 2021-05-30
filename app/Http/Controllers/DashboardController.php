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
            ) AS z');
        return view('dashboard', compact('tahun', 'year'));
    }
}
