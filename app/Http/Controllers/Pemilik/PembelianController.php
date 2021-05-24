<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function getId()
    {
        $data = DB::select('SELECT MAX(id) maxId FROM transaksi_pembelian WHERE STATUS <> "On"');
        $id = $data[0]->maxId;
        $noUrut = (int) substr($id, 3, 4);
        $noUrut++;
        return "PMB" . sprintf("%04s", $noUrut);
    }

    public function index()
    {
        $pembelian = TransaksiPembelian::all();
        return view('pemilik.pembelian.index', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id = $this->getId();
        $kontak = Kontak::where('status', 'Supplier')->get();
        $transaksi = TransaksiPembelianDetail::where('pembelian_id', $this->getId())->get();

        return view('pemilik.pembelian.tambah', compact('kontak', 'id', 'transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $trx = TransaksiPembelian::find($req->id_pembelian);

        if ($trx == null) {
            TransaksiPembelian::create([
                'id' => $req->id_pembelian,
                'grand_total' => $req->total,
                'status' => 'On',
            ]);
        } else {
            TransaksiPembelian::find($req->id_pembelian)->increment('grand_total', $req->total);
        }

        TransaksiPembelianDetail::create([
            'pembelian_id' => $req->id_pembelian,
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
        // dd($req->all());
        TransaksiPembelian::where('id', $req->id)->update([
            'tanggal' => $req->tanggal,
            'kontak_id' => $req->kontak,
            'grand_total' => $req->total,
            'status' => 'Simpan',
        ]);
        return redirect()->route('pembelian')->with('berhasil', 'Data berhasil disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus(Request $req)
    {
        TransaksiPembelianDetail::where('pembelian_id', $req->idpnj)->delete();
        TransaksiPembelian::where('id', $req->idpnj)->delete();
        return redirect()->route('pembelian')->with('berhasil', 'Data berhasil dihapus!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pmb = TransaksiPembelianDetail::find($id);
        TransaksiPembelian::find($pmb->pembelian_id)->decrement('grand_total', $pmb->total);
        TransaksiPembelianDetail::where('id', $id)->delete();
        return redirect()->back();
    }

    public function batal($id)
    {
        TransaksiPembelianDetail::where('pembelian_id', $id)->delete();
        TransaksiPembelian::where('id', $id)->delete();
        return redirect()->route('pembelian')->with('berhasil', 'Transaksi dibatalkan!');
    }
}
