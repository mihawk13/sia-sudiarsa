<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\TransaksiBiaya;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biaya = TransaksiBiaya::all();
        $akun = Akun::where('kode', 'LIKE', '6%')->Orwhere('kode', 'LIKE', '1-2%')->get();
        return view('pemilik.biaya', compact('biaya', 'akun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        TransaksiBiaya::create([
            'tanggal' => $req->tanggal,
            'akun_id' => $req->akun_id,
            'ket' => $req->ket,
            'jumlah' => $req->jumlah,
        ]);

        $back = "biaya";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.biaya";
        }

        return redirect()->route($back)->with('berhasil', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        TransaksiBiaya::where('id', $req->id)->update([
            'tanggal' => $req->tanggal,
            'ket' => $req->ket,
            'jumlah' => $req->jumlah,
        ]);

        $back = "biaya";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.biaya";
        }

        return redirect()->route($back)->with('berhasil', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
