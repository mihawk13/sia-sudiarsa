<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['id', 'tanggal', 'kontak_id', 'grand_total', 'status'];

    public function detail()
    {
        return $this->hasOne(TransaksiPenjualanDetail::class, 'penjualan_id', 'id');
    }

    public function kontak()
    {
        return $this->hasOne(Kontak::class, 'id', 'kontak_id');
    }
}
