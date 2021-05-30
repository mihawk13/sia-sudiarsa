@extends('layouts.app')


@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Tambah Pembelian</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Tambah Pembelian</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<x-messages />

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" readonly value="{{ $id }}">
                    <div class="d-flex justify-content-between">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="tanggal" class="control-label">Tanggal:</label>
                                <input type="date" class="form-control" name="tanggal" required
                                    placeholder="Masukkan Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="kontak" class="control-label">Kontak:</label>
                                <select name="kontak" class="form-control" required>
                                    <option selected value="">--Pilih Kontak--</option>
                                    @foreach ($kontak as $ktk)
                                    <option value="{{ $ktk->id }}">{{ $ktk->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="akun" class="control-label">Akun Kas:</label>
                                <select name="akun" class="form-control" required>
                                    <option selected value="">--Pilih Akun Kas--</option>
                                    @foreach ($akun as $akn)
                                    <option value="{{ $akn->id }}">{{ $akn->kode . ' - ' . $akn->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                @php
                                $total = 0;
                                @endphp
                                @foreach ($transaksi as $trx)
                                @php
                                $total += $trx->total;
                                @endphp
                                @endforeach
                                <label for="total" class="control-label">Total Pembelian:</label>
                                <input type="number" class="form-control" name="total" readonly value="{{ $total }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-icon-anim btn-square"><i
                                    class="fa fa-save"></i> Simpan</button>
                            <a href="@if(auth()->user()->level == 'Karyawan') {{ route('karyawan.pembelian.batal', $id)  }} @else {{ route('pembelian.batal', $id)  }} @endif" type="button" class="btn btn-danger btn-icon-anim btn-square"><i
                                    class="fa fa-times"></i> Batal</a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @livewire('pembelian', ['id_pembelian' => $id])
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $trx)
                            <tr>
                                <form method="post" action="@if(auth()->user()->level == 'Karyawan') {{ route('karyawan.pembelian.hapus', $trx->id)  }} @else {{ route('pembelian.hapus', $trx->id)  }} @endif">
                                    @csrf
                                    @method('Delete')
                                    <td>{{ $trx->barang->nama }}</td>
                                    <td>{{ $trx->jumlah }}</td>
                                    <td>{{ $trx->harga }}</td>
                                    <td>{{ $trx->total }}</td>
                                    <td width="10%">
                                        <center>
                                            <button type="submit" class="btn btn-danger btn-icon-anim btn-square"
                                                data-toggle="tooltip" data-placement="left" title="Hapus"><i
                                                    class="fa fa-trash"></i></button>
                                        </center>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
