<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontak = Kontak::all();
        return view('pemilik.kontak', compact('kontak'));
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
        Kontak::create([
            'nama' => $req->nama,
            'status' => $req->status,
            'telp' => $req->telp,
        ]);

        $back = "kontak";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.kontak";
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
        Kontak::where('id', $req->id)->update([
            'nama' => $req->nama,
            'status' => $req->status,
            'telp' => $req->telp,
        ]);

        $back = "kontak";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.kontak";
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
