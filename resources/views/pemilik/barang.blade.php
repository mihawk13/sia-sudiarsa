@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Barang</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Barang</li>
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
                                    <h4 class="modal-title">Tambah Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="kode" class="control-label">Kode:</label>
                                        <input type="text" class="form-control" name="kode" required
                                            placeholder="Masukkan Kode Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="control-label">Nama:</label>
                                        <input type="text" class="form-control" name="nama" required
                                            placeholder="Masukkan Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="merk" class="control-label">Merk:</label>
                                        <select name="merk" class="form-control">
                                            <option selected disabled>--Pilih Merk Helm--</option>
                                            @foreach (getMerkHelm() as $itm)
                                            <option value="{{ $itm }}">{{ $itm }}</option>
                                            @endforeach
                                        </select>
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
                                <th>Merk</th>
                                <th>Stock</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $brg)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $brg->kode }}</td>
                                <td>{{ $brg->nama }}</td>
                                <td>{{ $brg->merk }}</td>
                                <td>{{ number_format($brg->stock) }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Ubah Data Kontak"
                                            data-target="#ubah{{ $brg->id }}"><i class="fa fa-pencil"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="ubah{{ $brg->id }}" class="modal fade" tabindex="-1" role="dialog"
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
                                                <input type="hidden" name="id" value="{{ $brg->id }}">
                                                <div class="form-group">
                                                    <label for="kode" class="control-label">Kode:</label>
                                                    <input type="text" class="form-control" name="kode" readonly
                                                        value="{{ $brg->kode }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama:</label>
                                                    <input type="text" class="form-control" name="nama" required
                                                        placeholder="Masukkan Nama" value="{{ $brg->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="merk" class="control-label">Merk:</label>
                                                    <select name="merk" class="form-control">
                                                        @foreach (getMerkHelm() as $itm)
                                                        <option @if($brg->merk == $itm) selected @endif value="{{ $itm }}">{{ $itm }}</option>
                                                        @endforeach
                                                    </select>
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
