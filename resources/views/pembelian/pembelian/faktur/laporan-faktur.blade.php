@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan Faktur')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Faktur</a></li>
<li class="active">Laporan Faktur</li>
@endsection

@section('isi')
<div class=" mx-5 dt-buttons">
    <form class="d-flex" action="/pembelian/fakturs/laporanfilter" method="get">
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

<form action="/pembelian/fakturs/laporanpdf">
<div class="d-flex justify-content-end mx-5">
    <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf"  target="_blank">Export PDF </a></button>
</div>
<div class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan Faktur</h5>
        <!-- <input type="hidden" name="id" value="{faktur->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode faktur : {faktur->kode_faktur}}</td>
                <td>Pemasok : {faktur->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {faktur->tanggal}}</td>
                <td>Status : {faktur->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table class="table table-striped ">
            <thead >
                <tr>
                    <th>Kode Faktur</th>
                    <th>pemasok</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fakturs as $faktur)
                <tr>
                    <td>{{ $faktur->kode_faktur }}</td>
                    <td>{{ $faktur->pemasok->nama_pemasok }}</td>
                    <td>{{ $faktur->tanggal }}</td>
                    <td>{{ $faktur->total_harga }}</td>
                    <td>{{ $faktur->status !=null ? $faktur->status  : '-' }} | 
                        @if ($faktur->status_posting == 'sudah posting')
                            sudah posting 
                        @elseif ($faktur->status_posting == 'konfirmasi')
                        belum posting
                        @else
                        konfirmasi
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</form>
@endsection