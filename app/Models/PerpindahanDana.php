<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpindahanDana extends Model
{
    use HasFactory;

    protected $table = 'perpindahan_dana';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'dari', 'ke', 'jumlah'];

    public function dari_akun()
    {
        return $this->hasOne(Akun::class, 'id', 'dari');
    }

    public function ke_akun()
    {
        return $this->hasOne(Akun::class, 'id', 'ke');
    }

}
