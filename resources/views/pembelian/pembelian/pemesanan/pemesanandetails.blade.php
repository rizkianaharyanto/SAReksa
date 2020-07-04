@extends('pembelian.template.table')

@section('judul', 'Details')

@section('halaman', 'Details Pemesanan')

@section('path')
<li><a href="#">Transaksi</a></li>
<li><a href="/pembelian/pemesanans">Pemesanan</a></li>
<li class="active">Detail Pemesanan</li>
@endsection

@section('isi')
<form action="/pembelian/pemesanans/cetak_pdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button class="btn btn-light"><a class="px-2" id="pdf"  target="_blank">Export PDF</a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>

    <div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header p-4">
                                     <a class="pt-2 d-inline-block">Pemesanan Pembelian</a>
                                    <input type="hidden" name="id" value="{{$pemesanan->id}}">
                                    <div class="float-right"> <h3 class="mb-0">{{$pemesanan->kode_pemesanan}}</h3>
                                    {{$pemesanan->tanggal}}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">Pemasok:</h5>                                            
                                            <h3 class="text-dark mb-1">{{$pemesanan->pemasok->nama_pemasok}}</h3>
                                         
                                            <div>{{$pemesanan->pemasok->alamat_pemasok}}</div>
                                            <div>Phone: {{$pemesanan->pemasok->telp_pemasok}}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">Gudang:</h5>
                                            <h3 class="text-dark mb-1">{{$gudang->kode_gudang}}</h3>                                            
                                            <div>{{$gudang->alamat}}</div>
                                            <div>Phone: {{$gudang->no_telp}}</div>
                                        </div>
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped">
                                            <thead >
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
                </div>
<!-- <div style="overflow:auto; height: 80vh;" class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
    <center class="mb-4">
		<h5>Pemesanan</h4>
        <input type="hidden" name="id" value="{{$pemesanan->id}}">
    </center>
    <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode pemesanan : {{$pemesanan->kode_pemesanan}}</td>
                <td>Pemasok : {{$pemesanan->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {{$pemesanan->tanggal}}</td>
                <td>Gudang : {{$gudang->kode_gudang}}</td>
            </tr>
            </tbody>
        </table>

	
    </div>
</div> -->
</form>
@endsection