<?php

namespace App\Http\Livewire;

use App\Models\Akun;
use Livewire\Component;

class Kas extends Component
{
    public $kode = '';
    public $nama = '';

    public function render()
    {
        $akun = Akun::all();
        return view('livewire.kas', compact('akun'));
    }

    public function UpdatedKode($kode)
    {
        $akun = Akun::where('kode', $kode)->get();
        $this->nama = $akun[0]->nama;
    }
}
