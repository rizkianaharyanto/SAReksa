@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan Faktur')

@section('isi')
<form action="/pembelian/fakturs/laporanpdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
<div style="overflow:auto; height: 80vh;" class="m-2">
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

	<table class="table table-striped table-bordered">
            <thead style="background-color: #00BFA6; color:whitesmoke" >
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