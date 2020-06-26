@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan permintaan')

@section('isi')
<form action="/pembelian/permintaans/laporanpdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
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

	<table class="table table-striped table-bordered">
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