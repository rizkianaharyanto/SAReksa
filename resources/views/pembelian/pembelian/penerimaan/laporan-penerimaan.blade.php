@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan penerimaan')

@section('isi')
<form action="/pembelian/penerimaans/laporanpdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
<div style="overflow:auto; height: 80vh;" class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Laporan penerimaan</h5>
        <!-- <input type="hidden" name="id" value="{penerimaan->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode penerimaan : {penerimaan->kode_penerimaan}}</td>
                <td>Pemasok : {penerimaan->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {penerimaan->tanggal}}</td>
                <td>Status : {penerimaan->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table class="table table-striped table-bordered">
            <thead style="background-color: #00BFA6; color:whitesmoke" >
                <tr>
                    <th>Kode Penerimaan</th>
                    <th>pemasok</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($penerimaans as $penerimaan)
                <tr>
                    <td>{{ $penerimaan->kode_penerimaan }}</td>
                    <td>{{ $penerimaan->pemasok->nama_pemasok }}</td>
                    <td>{{ $penerimaan->tanggal }}</td>
                    <td>{{ $penerimaan->total_harga }}</td>
                    <td>
                        @if ($penerimaan->status == 'sudah posting')
                            sudah posting 
                        @elseif ($penerimaan->status == 'selesai')
                            selesai
                        @elseif ($penerimaan->status == 'konfirmasi')
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