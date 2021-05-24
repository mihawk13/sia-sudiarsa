<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBiaya extends Model
{
    use HasFactory;

    protected $table = 'transaksi_biaya';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'kode_akun', 'nama_akun', 'ket', 'jumlah'];
}
