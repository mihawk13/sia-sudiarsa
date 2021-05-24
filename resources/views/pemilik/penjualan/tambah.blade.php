@extends('layouts.app')


@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Tambah Penjualan</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Tambah Penjualan</li>
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
                                <label for="total" class="control-label">Total Penjualan:</label>
                                <input type="number" class="form-control" name="total" readonly value="{{ $total }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-icon-anim btn-square"><i
                                    class="fa fa-save"></i> Simpan</button>
                            <a href="{{ route('penjualan.batal', $id) }}" type="button" class="btn btn-danger btn-icon-anim btn-square"><i
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
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @livewire('penjualan', ['id_penjualan' => $id])
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $trx)
                            <tr>
                                <form method="post" action="{{ route('penjualan.hapus', $trx->id) }}">
                                    @csrf
                                    @method('Delete')
                                    <td>{{ $trx->barang->nama }}</td>
                                    <td>{{ $trx->satuan }}</td>
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

{{-- @section('script')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection --}}
