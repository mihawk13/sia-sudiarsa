@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Catatan Atas Laporan Keuangan</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Catatan Atas Laporan Keuangan</li>
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
                            href="{{ route('lap.calk.cetak', [$dari, $hingga]) }}" target="_blank">Cetak</a>
                    </div>
                    @endif
                </form>

                @if ($dari)

                @php
                $totPendapatan = 0;
                $totBeban = 0;
                $totLaba = 0;
                $totPembelian = 0;
                @endphp

                @foreach ($pemasukan as $pms)
                @php
                $totLaba += $pms->jumlah;
                @endphp
                @endforeach

                @foreach ($pembelian as $pmb)
                @php
                $totPembelian += $pmb->jumlah;
                @endphp
                @endforeach

                @foreach ($beban as $bbn)
                @php
                $totBeban += $bbn->jumlah;
                @endphp
                @endforeach

                @php
                $totPendapatan = $totLaba - ($totBeban + $totPembelian);
                @endphp

                <div class="table-responsive m-t-40">
                    <table class="table">
                        <h5>a. Gambaran Umum Usaha</h5>
                        <p>Usaha ini berdiri pada tahun 2004, dan bergerak dibidang usaha dagang menjual helm<br>
                            dengan berbagai jenis dan merk. Berstandar Nasional Indonesia (SNI)</p>
                        <h5>b. Penyusunan Laporan Keuangan</h5>
                        <p>Dasar-dasar dari penyusunan Laporan Keuangan pada usaha ini yaitu mengikuti<br>
                            aturan Standar Akuntasnsi Keuangan - Entitas Mikro Kecil dan Menengah (SAK-EMKM)</p>
                        <h5>c. Informasi Laporan Keuangan</h5>
                        <tbody>
                            <tr>
                                <td>Total Pembelian</td>
                                <td>Rp. {{ number_format($totPembelian) }}</td>
                            </tr>
                            <tr>
                                <td>Total Beban</td>
                                <td>Rp. {{ number_format($totBeban) }}</td>
                            </tr>
                            <tr>
                                <td>Laba Bersih Bulan Ini</td>
                                <td>Rp. {{ number_format($totLaba) }}</td>
                            </tr>
                            <tr>
                                <td>Total Pendapatan</td>
                                <td>Rp. {{ number_format($totPendapatan) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
