@extends('penjualan.template.table', [
    'elementActive' => 'laporan'
])

@section('judul', 'Laporan')

@section('menu', 'Laporan Pembayaran Piutang')

@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">  
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-body">
                                        <form action="/penjualan/laporans/pembayaranpdf">
                                        @csrf
                                            <div class="d-flex justify-content-end mx-5">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                            </div>
                                            <div style="overflow:auto; height: 80vh;" class="m-2">
                                                <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <input type="hidden" name="bulan_angka" value='{{$bulanangka}}'>
                                                <input type="hidden" name="tahun" value='{{$tahun}}'>
                                                <center class="mb-4">
                                                    <h4>Laporan Pembayaran Piutang</h4>
                                                    <h5>Periode {{$bulan}} {{$tahun}}</h5>
                                                    <!-- <input type="hidden" name="id" value="{pembayaran->id}}"> -->
                                                </center>
                                                <!-- <table class="table table-sm">
                                                        <tbody>
                                                        <tr>
                                                            <td>Kode pembayaran : {pembayaran->kode_pembayaran}}</td>
                                                            <td>Pemasok : {pembayaran->penjual->nama_penjual}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal : {pembayaran->tanggal}}</td>
                                                            <td>Status : {pembayaran->status}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table> -->

                                                    <table class="table table-striped table-bordered">
                                                            <thead style="background-color: #212120; color:whitesmoke" >
                                                                <tr>
                                                                    <th>Kode Pembayaran</th>
                                                                    <th>Pelanggan</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Status</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($pembayaran as $pembayaran)
                                                                <tr>
                                                                    <td>{{ $pembayaran->kode_pembayaran }}</td>
                                                                    <td>{{ $pembayaran->pelanggan->nama_pelanggan }}</td>
                                                                    <td>{{ $pembayaran->tanggal }}</td>
                                                                    @if($pembayaran->status_posting == 'sudah posting')
                                                                    <td>Diterima</td>
                                                                    @elseif($pembayaran->status_posting == 'belum posting')
                                                                    <td>Belum Diterima</td>
                                                                    @endif
                                                                    <td>{{ $pembayaran->total }}</td>
                                                                </tr>
                                                                @endforeach
                                                                <tr>
                                                                <td colspan="4" class="text-right pr-3">TOTAL KESELURUHAN</td>
                                                                <td id="subtotal">{{ $total }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection