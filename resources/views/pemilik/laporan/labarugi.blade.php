@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Laporan Laba Rugi</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Laporan Laba Rugi</li>
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
                            href="{{ route('lap.labarugi.cetak', [$dari, $hingga]) }}" target="_blank">Cetak</a>
                    </div>
                    @endif
                </form>

                @if ($dari)

                <div class="table-responsive m-t-40">
                    <table class="table">
                        <tbody>
                            {{-- pendapatan --}}
                            <tr>
                                <td colspan="4">Pendapatan Usaha</td>
                            </tr>
                            @php
                            $totPendapatan = 0;
                            $totBeban = 0;
                            $totLabaRugi = 0;
                            @endphp
                            @foreach ($pemasukan as $pms)
                            @php
                            $totPendapatan += $pms->jumlah;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pms->nama }}</td>
                                <td class="text-right">Rp. {{ number_format($pms->jumlah) }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Jumlah Pendapatan</td>
                                <td class="text-right">Rp. {{ number_format($totPendapatan) }}</td>
                            </tr>
                            {{-- pendapatan --}}
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            {{-- beban --}}
                            <tr>
                                <td colspan="4">Beban Usaha</td>
                            </tr>
                            @foreach ($beban as $bbn)
                            @php
                            $totBeban += $bbn->jumlah;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bbn->nama }}</td>
                                <td class="text-right">Rp. {{ number_format($bbn->jumlah) }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Jumlah Beban</td>
                                <td class="text-right">(Rp. {{ number_format($totBeban) }})</td>
                            </tr>
                            {{-- beban --}}
                        </tbody>
                        @php
                        $totLabaRugi = $totPendapatan - $totBeban;
                        $ketLabRug = ($totLabaRugi < 0) ? 'Total Kerugian' : 'Laba Bersih' ; @endphp <tfoot>
                            <tr>
                                <td colspan="3"><strong
                                        class="@if ($totLabaRugi < 0) text-danger @else text-success @endif">{{ $ketLabRug }}</strong>
                                </td>
                                <td class="text-right">Rp. {{ number_format($totLabaRugi) }}</td>
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
