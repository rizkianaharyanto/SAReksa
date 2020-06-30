@extends('penjualan.template.table', [
    'elementActive' => 'pemesanan'
])
@section('judul', 'Pemesanan')

@section('menu', 'Detail Pemesanan')
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
                                        <form method='POST' action="/penjualan/pemesanans/cetak_pdf">
                                            @csrf
                                            <div class="d-flex justify-content-end mx-5">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                            </div>
                                            <div style="overflow:auto; height: 80vh;" class="m-2">
                                                <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <center class="mb-4">
                                                    <h5>Pemesanan</h4>
                                                    <input type="hidden" name="id" value="{{$pemesanan->id}}">
                                                </center>
                                                <table class="table table-sm">
                                                        <tbody>
                                                        <tr>
                                                            <td>Kode Pemesanan : {{$pemesanan->kode_pemesanan}}</td>
                                                            <td>Pelanggan : {{$pemesanan->pelanggan->nama_pelanggan}}</td>
                                                        </tr>
                                                        <tr>
                                                        <td>Sales : {{$pemesanan->penjual->nama_penjual}}</td>
                                                            <td>Gudang : {{$gudang->kode_gudang}}</td>
                                                        </tr>
                                                        <tr>
                                                        <td>Tanggal : {{$pemesanan->tanggal}}</td>

                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                <table class="table table-striped table-bordered">
                                                        <thead style="background-color: #212120; color:whitesmoke" >
                                                            <tr>
                                                                <th>Nama Barang</th>
                                                                <th>QTY</th>
                                                                <th>Unit</th>
                                                                <th>Status</th>
                                                                <th>Harga</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($barangs as $index => $barang)
                                                                <tr>
                                                                    <td>{{$barang->nama_barang ? $barang->nama_barang : '-' }}</td>
                                                                    <td>{{$barang->pivot->jumlah_barang ? $barang->pivot->jumlah_barang : '-' }}</td>
                                                                    <td>{{ $barang->pivot->unit ? $barang->pivot->unit : '-' }}</td>
                                                                    <td>{{ $barang->pivot->status_barang ? $barang->pivot->status_barang : '-' }}</td>
                                                                    <td>{{ $barang->pivot->harga ? $barang->pivot->harga : '-' }}</td>
                                                                    <td>{{$total_harga[$index]}}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="5" class="text-right pr-3">Sub total</td>
                                                                <td id="subtotal">{{$subtotal}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" class="text-right pr-3">Diskon</td>
                                                                <td id="diskon">{{$diskon}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" class="text-right pr-3">Biaya lain</td>
                                                                <td id="biaya_lain">{{$biaya_lain}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" class="text-right pr-3">Total</td>
                                                                <td id="total_seluruh">{{$total_seluruh}}</td>
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
</div>

@endsection