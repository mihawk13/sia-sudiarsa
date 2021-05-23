@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Kontak</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Kontak</li>
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
                                    <h4 class="modal-title">Tambah Kontak</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="nama" class="control-label">Nama:</label>
                                        <input type="text" class="form-control" name="nama" required
                                            placeholder="Masukkan Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="control-label">Status:</label>
                                        <select name="status" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            <option value="Customer">Customer</option>
                                            <option value="Supplier">Supplier</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="telp" class="control-label">No Telp:</label>
                                        <input type="text" class="form-control" name="telp" required
                                            placeholder="Masukkan No Telphone">
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
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kontak as $ktk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ktk->nama }}</td>
                                <td>{{ $ktk->status }}</td>
                                <td>{{ $ktk->telp }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Ubah Data Kontak"
                                            data-target="#ubah{{ $ktk->id }}"><i class="fa fa-pencil"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="ubah{{ $ktk->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Kontak</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $ktk->id }}">
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama:</label>
                                                    <input type="text" class="form-control" name="nama" required
                                                        placeholder="Masukkan Nama" value="{{ $ktk->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status" class="control-label">Status:</label>
                                                    <select name="status" class="form-control">
                                                        <option value="">--Pilih Status--</option>
                                                        <option @if($ktk->status == 'Customer') selected @endif value="Customer">Customer</option>
                                                        <option @if($ktk->status == 'Supplier') selected @endif value="Supplier">Supplier</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp" class="control-label">No Telp:</label>
                                                <input type="text" class="form-control" name="telp" required
                                                    placeholder="Masukkan No Telphone" value="{{ $ktk->telp }}">
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
