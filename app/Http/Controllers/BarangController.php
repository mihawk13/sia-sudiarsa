<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('pemilik.barang', compact('barang'));
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

        $back = "barang";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.barang";
        }

        try {
            Barang::where('nama', $req->nama)->firstOrFail();
            return redirect()->route($back)->with('gagal', 'Nama sudah digunakan!');
        } catch (\Throwable $th) {
            try {
                Barang::where('kode', $req->kode)->firstOrFail();
                return redirect()->route($back)->with('gagal', 'Kode sudah digunakan!');
            } catch (\Throwable $th) {
                try {

                    $req->validate([
                        'kode' => 'required|unique:barang',
                        'nama' => 'required',
                        'merk' => 'required',
                        'harga' => 'required',
                    ]);

                    Barang::create([
                        'kode' => $req->kode,
                        'nama' => $req->nama,
                        'merk' => $req->merk,
                        'harga_pokok' => $req->harga,
                    ]);

                    return redirect()->route($back)->with('berhasil', 'Data berhasil ditambah!');
                } catch (\Throwable $th) {
                    return redirect()->route($back)->with('gagal', $th->getMessage());
                }
            }
        }
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
        Barang::where('id', $req->id)->update([
            'nama' => $req->nama,
            'merk' => $req->merk,
            'harga_pokok' => $req->harga,
        ]);

        $back = "barang";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.barang";
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
