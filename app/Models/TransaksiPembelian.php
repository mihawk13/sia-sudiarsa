<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pembelian';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['id', 'tanggal', 'kontak_id', 'akun_id', 'grand_total', 'status'];

    public function detail()
    {
        return $this->hasOne(TransaksiPembelianDetail::class, 'pembelian_id', 'id');
    }

    public function kontak()
    {
        return $this->hasOne(Kontak::class, 'id', 'kontak_id');
    }

    public function akun()
    {
        return $this->hasOne(Akun::class, 'id', 'akun_id');
    }
}
