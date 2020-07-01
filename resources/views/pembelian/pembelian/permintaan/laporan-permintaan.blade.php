@extends('pembelian.template.table')

@section('judul', 'Laporan Permintaan')

@section('halaman', 'Laporan Permintaan')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Permintaan</a></li>
<li class="active">Laporan Permintaan</li>
@endsection

@section('tambah')
<div class="d-flex justify-content-end mx-5 dt-buttons">
    <form class="d-flex" action="/pembelian/permintaans/laporanfilter" method="get">
        @csrf
        <input class="form-control m-2" type="date" name="start">
        <input class="form-control m-2" type="date" name="end">
        <button class="btn btn-outline-info m-2" type="submit">Filter</button>
    </form>
    <button class="btn btn-outline-info m-2"><a class="px-2" id="pdf"  target="_blank">Export PDF </a></button>
    <!-- <a class="px-2" href="">Export Excel | </a> -->
        <!-- <a class="px-2" href="">Print | </a> -->
        <!-- <button class="dt-button button-html5 button-excel" aria-controls="example" tabindex="0"><span>Excel</span></button>
        <button class="dt-button button-html5 button-pdf" aria-controls="example" tabindex="0"><span>PDF</span></button>
        <button class="dt-button button-html5 button-print" aria-controls="example" tabindex="0"><span>Print</span></button> -->
    </div>
@endsection

@section('isi')
<form action="/pembelian/permintaans/laporanpdf">
    @csrf
<div style="overflow:auto; height: 80vh;" class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan permintaan</h5>
        <!-- <input type="hidden" name="id" value="{permintaan->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode permintaan : {permintaan->kode_permintaan}}</td>
                <td>Pemasok : {permintaan->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {permintaan->tanggal}}</td>
                <td>Status : {permintaan->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table id="example" class="table table-striped table-bordered">
            <thead style="background-color: #00BFA6; color:whitesmoke" >
                <tr>
                    <th>Kode Permintaan</th>
                    <th>pemasok</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permintaans as $permintaan)
                <tr>
                    <td>{{ $permintaan->kode_permintaan }}</td>
                    <td>{{ $permintaan->pemasok->nama_pemasok }}</td>
                    <td>{{ $permintaan->tanggal }}</td>
                    <td>{{ $permintaan->total_harga }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</form>


@endsection