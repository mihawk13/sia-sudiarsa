@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Transaksi Kas</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Transaksi Kas</li>
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
                <button class="btn btn-info waves-effect waves-light" type="button" data-toggle="modal"
                    data-target="#tambah"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah</button>
                <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Transaksi Kas</h4>
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
                            @foreach ($kas as $kas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kas->tanggal }}</td>
                                <td>{{ $kas->nama_akun }}</td>
                                <td>{{ $kas->ket }}</td>
                                <td>{{ number_format($kas->jumlah) }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Ubah Data Kontak"
                                            data-target="#ubah{{ $kas->id }}"><i class="fa fa-pencil"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="ubah{{ $kas->id }}" class="modal fade" tabindex="-1" role="dialog"
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
                                                <input type="hidden" name="id" value="{{ $kas->id }}">
                                                <div class="form-group">
                                                    <label for="kode" class="control-label">Tanggal:</label>
                                                    <input type="date" class="form-control" name="tanggal" required
                                                        placeholder="Masukkan Tanggal" value="{{ $kas->tanggal }}">
                                                </div>
                                                <div class="form-group" wire:ignore>
                                                    <label for="kode" class="control-label">Kode Akun:</label>
                                                    <select id="kode" name="kode" class="form-control" readonly>
                                                        <option value="">{{ $kas->kode_akun }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama Akun:</label>
                                                    <input type="text" class="form-control" name="nama" readonly required
                                                        placeholder="Masukkan Nama Akun" value="{{ $kas->nama_akun }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ket" class="control-label">Keterangan:</label>
                                                    <input type="text" class="form-control" name="ket" required
                                                        placeholder="Masukkan Keterangan" value="{{ $kas->ket }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah" class="control-label">Jumlah:</label>
                                                    <input type="number" class="form-control" name="jumlah" required
                                                        placeholder="Masukkan Jumlah" value="{{ $kas->jumlah }}">
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
