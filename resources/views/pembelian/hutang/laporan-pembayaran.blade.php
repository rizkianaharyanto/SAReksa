@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan Pembayaran')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Pembayaran</a></li>
<li class="active">Laporan Pembayaran Hutang</li>
@endsection

@section('isi')
<div class=" mx-5 dt-buttons">
    <form class="d-flex" action="/pembelian/pembayarans/laporanfilter" method="get">
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

<form action="/pembelian/pembayarans/laporanpdf">
    <div class="d-flex justify-content-end mx-5">
        <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf" target="_blank">Export PDF </a></button>
    </div>
    <div class="m-2">
        <div style="background-color: white; color: black;" class="mx-5 p-3">
            <center class="mb-4">
                <h5>Laporan Pembayaran Hutang</h5>
            </center>

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Kode Pembayaran</th>
                        <th>Supplier</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->kode_pembayaran }}</td>
                        <td>{{ $pembayaran->pemasok->nama_pemasok }}</td>
                        <td>{{ $pembayaran->tanggal }}</td>
                        <td>{{ $pembayaran->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection