<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\PerpindahanDana;
use App\Models\TransaksiKas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kas = TransaksiKas::all();
        $akun = Akun::where('kode', 'LIKE', '3%')->get();
        $akunkas = Akun::where('kode', 'LIKE', '1%')->get();
        $dana = PerpindahanDana::all();
        return view('pemilik.kas', compact('kas', 'akun', 'dana', 'akunkas'));
    }

    public function store(Request $req)
    {
        TransaksiKas::create([
            'tanggal' => $req->tanggal,
            'akun_id' => $req->akun_id,
            'ket' => $req->ket,
            'jumlah' => $req->jumlah,
        ]);

        $back = "kas";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.kas";
        }

        return redirect()->route($back)->with('berhasil', 'Data berhasil ditambah!');
    }

    public function update(Request $req)
    {
        TransaksiKas::where('id', $req->id)->update([
            'tanggal' => $req->tanggal,
            'ket' => $req->ket,
            'jumlah' => $req->jumlah,
        ]);

        $back = "kas";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.kas";
        }

        return redirect()->route($back)->with('berhasil', 'Data berhasil diubah!');
    }

    public function perpindahan_dana(Request $req)
    {
        PerpindahanDana::create([
            'tanggal' => $req->tanggal,
            'dari' => $req->dari,
            'ke' => $req->ke,
            'jumlah' => $req->jumlah,
        ]);

        $back = "kas";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.kas";
        }

        return redirect()->route($back)->with('berhasil', 'Transfer dana berhasil disimpan!');
    }

    public function perpindahan_dana_hapus(Request $req)
    {
        PerpindahanDana::where('id', $req->id)->delete();

        $back = "kas";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.kas";
        }

        return redirect()->route($back)->with('berhasil', 'Transfer dana berhasil disimpan!');
    }
}
