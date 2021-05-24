<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan_detail';
    public $timestamps = false;

    protected $fillable = ['penjualan_id', 'barang_id', 'satuan', 'jumlah', 'harga', 'total'];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
}
