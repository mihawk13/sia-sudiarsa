<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';
    public $timestamps = false;

    protected $fillable = ['nama', 'status', 'telp'];

    // public function pegawai()
    // {
    //     return $this->hasOne(Pegawai::class, 'id', 'pegawai_id');
    // }
}
