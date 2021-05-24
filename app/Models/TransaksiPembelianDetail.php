<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pembelian_detail';
    public $timestamps = false;

    protected $fillable = ['pembelian_id', 'barang_id', 'jumlah', 'harga', 'total'];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
}
