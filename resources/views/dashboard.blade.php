@extends('layouts.app')

@section('css')
<!--This page css - Morris CSS -->
<link href="{{ asset('assets/plugins/morrisjs/morris.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <form method="POST" class="d-flex" action="{{ route('dashboard') }}">
        @csrf
        <div class="col-6" id="date-range">
            <select class="form-control" name="tahun" id="tahun" required>
                @foreach ($tahun as $thn)
                <option @if($year==$thn->tahun) selected @endif value="{{ $thn->tahun }}">{{ $thn->tahun }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <button class="btn btn-info waves-effect waves-light m-b-30" type="submit">Tampil</button>
        </div>
    </form>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Grafik Penjualan & Pembelian</h4>
                <div id="morris-bar-chart"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!--Morris JavaScript -->
<script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('assets/plugins/morrisjs/morris.js') }}"></script>

<script>
    $(function () {
    "use strict";
// Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Jan',
            a: 100,
            b: 90
        }, {
            y: 'Feb',
            a: 75,
            b: 65
        }, {
            y: 'Mar',
            a: 50,
            b: 40
        }, {
            y: 'Apr',
            a: 75,
            b: 65
        }, {
            y: 'Mei',
            a: 50,
            b: 40
        }, {
            y: 'Jun',
            a: 75,
            b: 65
        }, {
            y: 'Jul',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Penjualan', 'Pembelian'],
        barColors:['#55ce63', '#009efb'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });
 });
</script>
@endsection
