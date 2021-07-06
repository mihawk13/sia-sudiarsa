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
<!-- Card -->
<div class="card m-t-30" style="flex: 0 0 30%;
max-width: 30%;">
    <div class="custom-header font-weight-bold">
        <center>Saldo Kas</center>
    </div>
    <div class="card-body">
        <p class="font-weight-bold text-center">Rp. {{ number_format(getJmlKas()) }}</p>
    </div>
</div>
<!-- Card -->

<button class="btn btn-info waves-effect waves-light" type="button" data-toggle="modal" data-target="#tambah"><span
        class="btn-label"><i class="fa fa-plus"></i></span>Tambah</button>
<button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target="#transfer"><span
        class="btn-label"><i class="fa fa-money"></i></span>Transfer</button>

<div class="row m-t-20">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

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
                                <td>{{ $kas->akun->nama }}</td>
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
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama Akun:</label>
                                                    <input type="text" class="form-control" name="nama" readonly
                                                        required placeholder="Masukkan Nama Akun"
                                                        value="{{ $kas->akun->nama }}">
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

<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Transaksi Kas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode" class="control-label">Tanggal:</label>
                        <input type="date" class="form-control" name="tanggal" required placeholder="Masukkan Tanggal">
                    </div>
                    <div class="form-group">
                        <label for="akun_id" class="control-label">Akun Kas:</label>
                        <select id="akun_id" name="akun_id" class="form-control" required>
                            <option value="" disabled>--Pilih Akun Kas--</option>
                            @foreach ($akun as $akn)
                            <option value="{{ $akn->id }}">{{ $akn->kode . ' - ' . $akn->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ket" class="control-label">Keterangan:</label>
                        <input type="text" class="form-control" name="ket" required placeholder="Masukkan Keterangan">
                    </div>
                    <div class="form-group">
                        <label for="jumlah" class="control-label">Jumlah:</label>
                        <input type="number" class="form-control" name="jumlah" required placeholder="Masukkan Jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="transfer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('transfer') }}">
                @method('PATCH')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Dana</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode" class="control-label">Tanggal:</label>
                        <input type="date" class="form-control" name="tanggal" required placeholder="Masukkan Tanggal">
                    </div>
                    <div class="form-group">
                        <label for="dari" class="control-label">Dari Akun:</label>
                        <select id="dari" name="dari" class="form-control" required>
                            <option value="" disabled>--Pilih Akun Kas--</option>
                            @foreach ($akunkas as $akn)
                            <option @if(getSaldoAkun($akn->id)==0) disabled @endif
                                value="{{ $akn->id }}">{{ $akn->kode . ' - ' . $akn->nama . ' | ' . number_format(getSaldoAkun($akn->id))}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ke" class="control-label">Ke Akun:</label>
                        <select id="ke" name="ke" class="form-control" required>
                            <option value="" disabled>--Pilih Akun Kas--</option>
                            @foreach ($akunkas as $akn)
                            <option value="{{ $akn->id }}">{{ $akn->kode . ' - ' . $akn->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah" class="control-label">Jumlah:</label>
                        <input type="number" class="form-control" name="jumlah" required placeholder="Masukkan Jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3>Data Transfer Dana</h3>

                <div class="table-responsive m-t-40">
                    <table id="myTable2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Dari Akun</th>
                                <th>Ke Akun</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dana as $dana)
                            <tr>
                                <td>{{ $dana->tanggal }}</td>
                                <td>{{ $dana->dari_akun->nama }}</td>
                                <td>{{ $dana->ke_akun->nama }}</td>
                                <td>{{ number_format($dana->jumlah) }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Hapus Data Transfer Dana"
                                            data-target="#hapus{{ $dana->id }}"><i class="fa fa-trash"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="hapus{{ $dana->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('transfer.hapus') }}">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $dana->id }}">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Apakah anda yakin menghapus data ini?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect"
                                                    data-dismiss="modal">Tidak</button>
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light">Ya</button>
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
        $('#myTable2').DataTable();
    });
</script>
@endsection
