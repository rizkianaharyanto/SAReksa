@extends('pembelian.template.table')

@section('judul', 'Details')

@section('halaman', 'Details Retur')

@section('path')
<li><a href="#">Transaksi</a></li>
<li><a href="/pembelian/returs">Retur</a></li>
<li class="active">Detail Retur</li>
@endsection

@section('isi')
<form action="/pembelian/retur/cetak_pdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button class="btn btn-light"><a class="px-2" id="pdf" target="_blank">Export PDF</a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <a class="pt-2 d-inline-block">Retur Pembelian</a>
                    <input type="hidden" name="id" value="{{$retur->id}}">
                    <div class="float-right">
                        <h3 class="mb-0">{{$retur->kode_retur}}</h3>
                        {{$retur->tanggal}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">Pemasok:</h5>
                            <h3 class="text-dark mb-1">{{$retur->pemasok->nama_pemasok}}</h3>

                            <div>{{$retur->pemasok->alamat_pemasok}}</div>
                            <div>Phone: {{$retur->pemasok->telp_pemasok}}</div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3">Faktur:</h5>
                            <h3 class="text-dark mb-1">{{$faktur->kode_faktur}}</h3>
                            <!-- <div>Status: {{$retur->status}}</div> -->
                            <!-- <div>Phone: $gudang->no_telp</div> -->
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered">
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
                                    <td>@currency( $barang->pivot->harga)</td>
                                    <td>@currency($total_harga[$index])</td>
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
                                        <td class="right">@currency($subtotal)</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong class="text-dark">@currency($total_seluruh)</strong>
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