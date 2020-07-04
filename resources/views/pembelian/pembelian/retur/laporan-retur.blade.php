@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan retur')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Retur</a></li>
<li class="active">Laporan Retur Pembelian</li>
@endsection

@section('isi')

<div class=" mx-5">
    <form class="d-flex" action="/pembelian/returs/laporanfilter" method="get">
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

<form action="/pembelian/returs/laporanpdf">
<div class="d-flex justify-content-end mx-5">
    <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf"  target="_blank">Export PDF </a></button>
</div>

<div  class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan Retur Pembelian</h5>
        <!-- <input type="hidden" name="id" value="{retur->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode retur : {retur->kode_retur}}</td>
                <td>Pemasok : {retur->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {retur->tanggal}}</td>
                <td>Status : {retur->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table id="example" class="table table-striped">
            <thead  >
                <tr>
                    <th>Kode Retur</th>
                    <th>pemasok</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returs as $retur)    
                <tr>
                    <td>{{ $retur->kode_retur }}</td>
                    <td>{{ $retur->pemasok->nama_pemasok }}</td>
                    <td>{{ $retur->tanggal }}</td>
                    <td>{{ $retur->total_harga }}</td>
                    <td>{{ $retur->status !=null ? $retur->status  : '-' }} |
                        @if ($retur->status_posting == 'sudah posting')
                        sudah posting 
                        @elseif ($retur->status_posting == 'konfirmasi')
                        konfirmasi
                        @else
                        baru
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