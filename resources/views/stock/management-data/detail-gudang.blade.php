@extends('stock.standard-layout')
@section('main-content')

<div class="alert"></div>
<div class="row">
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="index.html">SMS REKSA</a>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">Gudang:</h5>
                        <h2 class="text-dark mb-1">{{$gudangs->kode_gudang}}</h2>

                        <div>{{$gudangs->alamat}}</div>
                        <div>{{$gudangs->no_telp}}</div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mb-3">Keterangan:</h5>
                        <div>{{$gudangs->status}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan unit</th>
                                <th class="right">Harga Jual</th>
                                <th class="center">Harga beli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gudangs->items as $i => $item)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->pivot->kuantitas}}</td>
                                <td>{{$item->unit->nama_satuan}}</td>
                                <td>{{$item->harga_retail}}</td>
                                <td>{{$item->harga_grosir}}</td>

                            </tr>
                            @endforeach </tbody>
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
                                        <strong class="text-dark">Total Barang</strong>
                                    </td>
                                    <td class="right">{{count($gudangs->items)}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
            </div>
        </div>
    </div>
</div>
@endsection