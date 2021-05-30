<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersediaanBarangController extends Controller
{
    public function index()
    {
        $dari = "";
        $hingga = "";
        return view('pemilik.laporan.persediaan', compact('dari', 'hingga'));
    }

    public function filter(Request $req)
    {
        $dari = $req->dari;
        $hingga = $req->hingga;
        $barang = Barang::all();
        return view('pemilik.laporan.persediaan', compact('dari', 'hingga', 'barang'));
    }
}
