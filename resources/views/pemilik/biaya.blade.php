@extends('layouts.app')

@section('css')
<style>
    .custom-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(19, 231, 54, 0.61);
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
</style>
@endsection

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Transaksi Biaya</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Transaksi Biaya</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<x-messages />
<!-- Card -->
<div class="card m-t-30" style="flex: 0 0 30%;
max-width: 30%;">
    <div class="custom-header font-weight-bold">
        <center>Total Biaya</center>
    </div>
    <div class="card-body">
        <p class="font-weight-bold text-center">Rp. {{ number_format(getJmlBiaya()) }}</p>
    </div>
</div>
<!-- Card -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-info waves-effect waves-light" type="button" data-toggle="modal"
                    data-target="#tambah"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah</button>
                <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Transaksi Biaya</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="kode" class="control-label">Tanggal:</label>
                                        <input type="date" class="form-control" name="tanggal" required
                                            placeholder="Masukkan Tanggal">
                                    </div>
                                    @livewire('kas')
                                    <div class="form-group">
                                        <label for="ket" class="control-label">Keterangan:</label>
                                        <input type="text" class="form-control" name="ket" required
                                            placeholder="Masukkan Keterangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah" class="control-label">Jumlah:</label>
                                        <input type="number" class="form-control" name="jumlah" required
                                            placeholder="Masukkan Jumlah">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit"
                                        class="btn btn-success waves-effect waves-light">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Akun</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($biaya as $byy)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $byy->tanggal }}</td>
                                <td>{{ $byy->nama_akun }}</td>
                                <td>{{ $byy->ket }}</td>
                                <td>{{ number_format($byy->jumlah) }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Ubah Data Kontak"
                                            data-target="#ubah{{ $byy->id }}"><i class="fa fa-pencil"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="ubah{{ $byy->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Barang</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $byy->id }}">
                                                <div class="form-group">
                                                    <label for="kode" class="control-label">Tanggal:</label>
                                                    <input type="date" class="form-control" name="tanggal" required
                                                        placeholder="Masukkan Tanggal" value="{{ $byy->tanggal }}">
                                                </div>
                                                <div class="form-group" wire:ignore>
                                                    <label for="kode" class="control-label">Kode Akun:</label>
                                                    <select id="kode" name="kode" class="form-control" readonly>
                                                        <option value="">{{ $byy->kode_akun }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama Akun:</label>
                                                    <input type="text" class="form-control" name="nama" readonly
                                                        required placeholder="Masukkan Nama Akun"
                                                        value="{{ $byy->nama_akun }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ket" class="control-label">Keterangan:</label>
                                                    <input type="text" class="form-control" name="ket" required
                                                        placeholder="Masukkan Keterangan" value="{{ $byy->ket }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah" class="control-label">Jumlah:</label>
                                                    <input type="number" class="form-control" name="jumlah" required
                                                        placeholder="Masukkan Jumlah" value="{{ $byy->jumlah }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection
