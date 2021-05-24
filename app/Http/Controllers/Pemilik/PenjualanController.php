<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function getId()
    {
        $data = DB::select('SELECT MAX(id) maxId FROM transaksi_penjualan WHERE STATUS <> "On"');
        $id = $data[0]->maxId;
        $noUrut = (int) substr($id, 3, 4);
        $noUrut++;
        return "PNJ" . sprintf("%04s", $noUrut);
    }

    public function index()
    {
        $penjualan = TransaksiPenjualan::all();
        return view('pemilik.penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id = $this->getId();
        $kontak = Kontak::where('status', 'Customer')->get();
        $transaksi = TransaksiPenjualanDetail::where('penjualan_id', $this->getId())->get();

        return view('pemilik.penjualan.tambah', compact('kontak', 'id', 'transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $trx = TransaksiPenjualan::find($req->id_penjualan);

        if ($trx == null) {
            TransaksiPenjualan::create([
                'id' => $req->id_penjualan,
                'grand_total' => $req->total,
                'status' => 'On',
            ]);
        } else {
            TransaksiPenjualan::find($req->id_penjualan)->increment('grand_total', $req->total);
        }

        TransaksiPenjualanDetail::create([
            'penjualan_id' => $req->id_penjualan,
            'barang_id' => $req->barang,
            'satuan' => $req->satuan,
            'jumlah' => $req->jumlah,
            'harga' => $req->harga,
            'total' => $req->total,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $req)
    {
        TransaksiPenjualan::where('id', $req->id)->update([
            'tanggal' => $req->tanggal,
            'kontak_id' => $req->kontak,
            'grand_total' => $req->total,
            'status' => 'Simpan',
        ]);

        $back = "penjualan";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.penjualan";
        }

        return redirect()->route($back)->with('berhasil', 'Data berhasil disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus(Request $req)
    {
        TransaksiPenjualanDetail::where('penjualan_id', $req->idpnj)->delete();
        TransaksiPenjualan::where('id', $req->idpnj)->delete();

        $back = "penjualan";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.penjualan";
        }

        return redirect()->route($back)->with('berhasil', 'Data berhasil dihapus!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pnj = TransaksiPenjualanDetail::find($id);
        TransaksiPenjualan::find($pnj->penjualan_id)->decrement('grand_total', $pnj->total);

        TransaksiPenjualanDetail::where('id', $id)->delete();
        return redirect()->back();
    }

    public function batal($id)
    {
        TransaksiPenjualanDetail::where('penjualan_id', $id)->delete();
        TransaksiPenjualan::where('id', $id)->delete();

        $back = "penjualan";
        if (auth()->user()->level == 'Karyawan') {
            $back = "karyawan.penjualan";
        }

        return redirect()->route($back)->with('berhasil', 'Transaksi dibatalkan!');
    }
}
