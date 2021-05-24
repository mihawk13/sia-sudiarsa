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
        <h3 class="text-themecolor">Transaksi Penjualan</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Transaksi Penjualan</li>
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
        <center>Total Penjualan</center>
    </div>
    <div class="card-body">
        <p class="font-weight-bold text-center">Rp. {{ number_format(getTotalPenjualan()) }}</p>
    </div>
</div>
<!-- Card -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="@if(auth()->user()->level == 'Karyawan') {{ route('karyawan.penjualan.tambah')  }} @else {{ route('penjualan.tambah')  }} @endif" class="btn btn-info waves-effect waves-light text-white" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah</a>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Customer</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $pnj)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pnj->tanggal }}</td>
                                <td>{{ $pnj->kontak->nama }}</td>
                                <td>{{ number_format($pnj->grand_total) }}</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm"
                                            data-toggle="modal" data-placement="left" title="Hapus Data Transaksi"
                                            data-target="#hapus{{ $pnj->id }}"><i class="fa fa-trash"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <div id="hapus{{ $pnj->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form method="POST">
                                            @csrf
                                            <input type="hidden" name="idpnj" value="{{ $pnj->id }}">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Apakah anda yakin menghapus transaksi ini?</h3>
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
    });
</script>
@endsection
