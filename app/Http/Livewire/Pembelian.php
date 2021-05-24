<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pembelian extends Component
{
    public $idp;
    public $barang = "";
    public $jumlah = 1;
    public $harga = 0;
    public $total = 0;

    public function mount($id_pembelian)
    {
        $this->idp = $id_pembelian;
    }

    public function render()
    {
        $brgOn = DB::select('SELECT barang_id FROM transaksi_pembelian_detail tpd
        INNER JOIN transaksi_pembelian tp ON tpd.pembelian_id=tp.id
        WHERE tp.status = "On"');
        $brgOn = array_map(function ($value) {
            return (array)$value;
        }, $brgOn);
        $barangs = Barang::whereNotIn('id', $brgOn)->get();
        return view('livewire.pembelian', compact('barangs'));
    }

    public function UpdatedBarang($brg_id)
    {
        try {
            $barang = Barang::find($brg_id);
            $this->harga = $barang->harga;
            $this->total = $barang->harga * $this->jumlah;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function UpdatedJumlah($jml)
    {
        $this->total = $this->harga * $jml;
    }
}
