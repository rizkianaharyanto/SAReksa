@extends('stock.standard-layout')

@section('css')
@parent
@endsection


@section('title','Stok Masuk')

@section('main-content')

<form action="/penjualan/pengirimans/cetak_pdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <!-- <button class="btn btn-light"><a class="px-2" id="pdf" target="_blank">Export PDF</a></button> -->
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <a class="pt-2 d-inline-block">pengiriman Pembelian</a>
                    <input type="hidden" name="id" value="{{$pengiriman->id}}">
                    <div class="float-right">
                        <h3 class="mb-0">{{$pengiriman->kode_pengiriman}}</h3>
                        {{$pengiriman->tanggal}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">pelanggan:</h5>
                            <h3 class="text-dark mb-1">{{$pengiriman->pelanggan->nama_pelanggan}}</h3>

                            <div>{{$pengiriman->pelanggan->alamat_pelanggan}}</div>
                            <div>Phone: {{$pengiriman->pelanggan->telp_pelanggan}}</div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3">Gudang:</h5>
                            <h3 class="text-dark mb-1">{{$gudang->kode_gudang}}</h3>
                            <div>{{$gudang->alamat}}</div>
                            <div>Phone: {{$gudang->no_telp}}</div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>QTY</th>
                                    <th>Unit</th>
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
                                    <td>{{ $barang->pivot->harga ? $barang->pivot->harga : '-' }}</td>
                                    <td>{{$total_harga[$index]}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Subtotal</strong>
                                        </td>
                                        <td class="right">{{$subtotal}}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Diskon</strong>
                                        </td>
                                        <td class="right">{{$diskon}}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Biaya Lain</strong>
                                        </td>
                                        <td class="right">{{$biaya_lain}}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong class="text-dark">{{$total_seluruh}}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-footer bg-white">
                                    <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                                </div> -->
            </div>
        </div>
    </div>

</form>
@endsection


@section('scripts')
@parent

@endsection