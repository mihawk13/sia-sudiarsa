@extends('layouts.app')

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Laporan Neraca</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pemilik</a></li>
            <li class="breadcrumb-item active">Laporan Neraca</li>
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
                            href="{{ route('lap.neraca.cetak', [$dari, $hingga]) }}" target="_blank">Cetak</a>
                    </div>
                    @endif
                </form>

                @if ($dari)

                <div class="table-responsive m-t-40">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Akun</th>
                                <th>Nama Akun</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totDebit = 0;
                            $totKredit = 0;
                            @endphp

                            @foreach ($laporan as $lap)
                            @if($lap->debit>0 || $lap->kredit>0)
                            @php
                            $totDebit += $lap->debit;
                            $totKredit += $lap->kredit;
                            @endphp
                            <tr>
                                <td>{{ $lap->kode }}</td>
                                <td>{{ $lap->nama }}</td>
                                <td>{{ number_format($lap->debit) }}</td>
                                <td>{{ number_format($lap->kredit) }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2"><strong>
                                        <center>Total</center>
                                    </strong></th>
                                <th><strong>{{ number_format($totDebit) }}</strong></th>
                                <th><strong>{{ number_format($totKredit) }}</strong></th>
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
