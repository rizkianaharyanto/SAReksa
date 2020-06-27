@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan retur')

@section('isi')
<form action="/pembelian/returs/laporanpdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
<div style="overflow:auto; height: 80vh;" class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan retur</h5>
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

	<table class="table table-striped table-bordered">
            <thead style="background-color: #00BFA6; color:whitesmoke" >
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