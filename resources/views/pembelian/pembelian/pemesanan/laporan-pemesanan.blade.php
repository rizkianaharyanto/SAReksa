@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan pemesanan')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Pemesanan</a></li>
<li class="active">Laporan Pemesanan</li>
@endsection

@section('isi')
<div class=" mx-5 dt-buttons">
    <form class="d-flex" action="/pembelian/pemesanans/laporanfilter" method="get">
        @csrf
        <input class="form-control m-2" type="date" name="start">
        <input class="form-control m-2" type="date" name="end">
        <button class="btn btn-outline-info m-2" type="submit">Filter</button>
    </form>
    <!-- <a class="px-2" href="">Export Excel | </a> -->
    <!-- <a class="px-2" href="">Print | </a> -->
    <!-- <button class="dt-button button-html5 button-excel" aria-controls="example" tabindex="0"><span>Excel</span></button>
    <button class="dt-button button-html5 button-pdf" aria-controls="example" tabindex="0"><span>PDF</span></button>
    <button class="dt-button button-html5 button-print" aria-controls="example" tabindex="0"><span>Print</span></button> -->
</div>

<form action="/pembelian/pemesanans/laporanpdf">

<div class="d-flex justify-content-end mx-5">
    <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf"  target="_blank">Export PDF </a></button>
</div>
<div  class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan Pemesanan</h5>
        <!-- <input type="hidden" name="id" value="{pemesanan->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode pemesanan : {pemesanan->kode_pemesanan}}</td>
                <td>Pemasok : {pemesanan->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {pemesanan->tanggal}}</td>
                <td>Status : {pemesanan->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table class="table table-striped ">
            <thead  >
                <tr>
                    <th>Kode Pemesanan</th>
                    <th>pemasok</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pemesanans as $pemesanan)
                <tr>
                    <td>{{ $pemesanan->kode_pemesanan }}</td>
                    <td>{{ $pemesanan->pemasok->nama_pemasok }}</td>
                    <td>{{ $pemesanan->tanggal }}</td>
                    <td>{{ $pemesanan->total_harga }}</td>
                    <td>{{ $pemesanan->status !=null ? $pemesanan->status  : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</form>
@endsection