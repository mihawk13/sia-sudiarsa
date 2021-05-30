@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Laporan Persediaan Barang Dagang</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Laporan Persediaan Barang Dagang</li>
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
                <form action="" method="POST" class="d-flex">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal" class="control-label">Dari:</label>
                        <input type="date" class="form-control" name="dari" required placeholder="Masukkan Tanggal"
                            value="{{ $dari }}">
                    </div>
                    <div class="form-group m-l-10">
                        <label for="hingga" class="control-label">Hingga:</label>
                        <input type="date" class="form-control" name="hingga" required placeholder="Masukkan Tanggal"
                            value="{{ $hingga }}">
                    </div>
                    <div class="form-group m-l-10">
                        <button class="btn btn-info waves-effect waves-light m-t-30" type="submit">Tampil</button>
                    </div>
                    @if ($dari)
                    <div class="form-group m-l-10">
                        <a class="btn btn-danger waves-effect waves-light m-t-30"
                            href="{{ route('lap.persediaan.cetak', [$dari, $hingga]) }}" target="_blank">Cetak</a>
                    </div>
                    @endif
                </form>

                @if ($dari)

                <div class="table-responsive m-t-40">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totStock = 0;
                            @endphp

                            @foreach ($barang as $brg)
                            @php
                            $masuk = getMasuk($dari, $hingga, $brg->id);
                            $keluar = getKeluar($dari, $hingga, $brg->id);
                            $totStock += $masuk - $keluar;
                            @endphp
                            <tr>
                                <td>{{ $brg->kode }}</td>
                                <td>{{ $brg->nama }}</td>
                                <td>{{ $masuk }}</td>
                                <td>{{ $keluar }}</td>
                                <td>{{ $masuk - $keluar }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4"><strong>
                                        <center>Total Persediaan</center>
                                    </strong></th>
                                <th><strong>{{ $totStock }}</strong></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
