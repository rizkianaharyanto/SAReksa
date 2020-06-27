@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan pemesanan')

@section('isi')
<form action="/pembelian/pemesanans/laporanpdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
<div style="overflow:auto; height: 80vh;" class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan pemesanan</h5>
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

	<table class="table table-striped table-bordered">
            <thead style="background-color: #00BFA6; color:whitesmoke" >
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