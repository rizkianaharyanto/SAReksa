@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan Hutang')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Hutang</a></li>
<li class="active">Laporan Hutang</li>
@endsection

@section('isi')
<div class="mx-5 dt-buttons">
    <!-- <form class="d-flex" action="/pembelian/hutangs/laporanfilter" method="get">
        @csrf
        <input class="form-control m-2" type="date" name="start">
        <input class="form-control m-2" type="date" name="end">
        <button class="btn btn-outline-info m-2" type="submit">Filter</button>
    </form> -->
    <!-- <a class="px-2" href="">Export Excel | </a> -->
    <!-- <a class="px-2" href="">Print | </a> -->
    <!-- <button class="dt-button button-html5 button-excel" aria-controls="example" tabindex="0"><span>Excel</span></button>
    <button class="dt-button button-html5 button-pdf" aria-controls="example" tabindex="0"><span>PDF</span></button>
    <button class="dt-button button-html5 button-print" aria-controls="example" tabindex="0"><span>Print</span></button> -->
</div>

<form action="/pembelian/hutangs/laporanpdf">
@csrf
<div class="d-flex justify-content-end mx-5">
    <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf"  target="_blank">Export PDF </a></button>
</div>
<div  class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan Hutang </h5>
        <!-- <input type="hidden" name="id" value="{hutang->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode Hutang : {Hutang->kode_Hutang}}</td>
                <td>Pemasok : {Hutang->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {Hutang->tanggal}}</td>
                <td>Status : {Hutang->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table class="table table-striped ">
            <thead >
                <tr>
                    <th>Pemasok</th>
                    <th>Total Hutang</th>
                    <th>Lunas</th>
                    <th>Sisa Hutang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasoks as $index => $pemasok)
                    <tr>
                        <td>{{ $pemasok->nama_pemasok }}</td>
                        <td>{{ $totals[$index]['total_hutang']}}</td>
                        <td>{{ $lunass[$index]['lunas']}}</td>
                        <td>{{ $sisas[$index]['sisa']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</form>
@endsection