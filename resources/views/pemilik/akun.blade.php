@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Akun</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Akun</li>
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
                                    <h4 class="modal-title">Tambah Akun</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="kode" class="control-label">Kode:</label>
                                        <input type="text" class="form-control" name="kode" required
                                            placeholder="Masukkan Kode Akun">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="control-label">Nama:</label>
                                        <input type="text" class="form-control" name="nama" required
                                            placeholder="Masukkan Nama Akun">
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
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Saldo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $akn)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $akn->kode }}</td>
                                <td>{{ $akn->nama }}</td>
                                <td>{{ number_format(getSaldoAkun($akn->id)) }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Ubah Data Akun"
                                            data-target="#ubah{{ $akn->id }}"><i class="fa fa-pencil"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="ubah{{ $akn->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Akun</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $akn->id }}">
                                                <div class="form-group">
                                                    <label for="kode" class="control-label">Kode:</label>
                                                    <input type="text" class="form-control" name="kode" readonly
                                                        placeholder="Masukkan Kode Akun" value="{{ $akn->kode }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama:</label>
                                                    <input type="text" class="form-control" name="nama" required
                                                        placeholder="Masukkan Nama" value="{{ $akn->nama }}">
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
