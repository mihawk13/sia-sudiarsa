<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBiaya extends Model
{
    use HasFactory;

    protected $table = 'transaksi_biaya';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'akun_id', 'ket', 'jumlah'];

    public function akun()
    {
        return $this->hasOne(Akun::class, 'id', 'akun_id');
    }
}
