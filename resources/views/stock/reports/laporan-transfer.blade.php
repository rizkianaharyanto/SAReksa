@extends('stock.reports.layout')

@section('title','Transfer Stock')

@section('isi')
<form action="/stok/reports/laporan-transfer/export" class="d-flex justify-content-end">
    <input type="hidden" name="start" value="{{$start}}">
    <input type="hidden" name="end" value="{{$end}}">
    <button type="submit" class="btn btn-primary my-2">Export PDF</button>
</form>
<div class="row">
    <!-- ============================================================== -->
    <div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Filter</h5>
            <div class="card-body">
                <form action="/stok/reports/laporan-transfer/filter" class="form-group">
                    <!-- <label for="gudang">Gudang</label>
                    <select class="form-control" name="gudang" id="gudang">
                        <option value="">--- All Gudang ---</option>
                        @foreach ($gudangs as $gudangfilter)
                        <option value="{{$gudangfilter->id}}">{{$gudangfilter->kode_gudang}}</option>
                        @endforeach
                    </select> -->
                    <label for="barang">Tanggal</label>
                    <input class="form-control" type="date" name="start">
                    <label for="barang">Tanggal</label>
                    <input class="form-control" type="date" name="end">
                    <button type="submit" class="btn btn-block btn-primary my-3">Filter</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="/stok">SMS REKSA</a>
                <div class="float-right">
                    <h3 class="mb-0">Laporan Transfer Stok</h3>
                </div>
            </div>
            <div class="card-body">
                <center>
                    <div class="row mb-4">
                        @if($start != null)
                        <div class="col">
                            <h5 class="mb-3">Periode:</h5>
                            <h3 class="text-dark mb-1">{{$start}} s.d {{$end}}</h3>
                        </div>
                        @else
                        @endif
                    </div>
                </center>
                @foreach ($allData as $transfer)
                <div class="table-responsive-sm mb-2 mt-5">
                    <div class="d-flex justify-content-between">
                        <h3>Kode : {{ $transfer->kode_ref }} </h3>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Gudang Asal</th>
                                <th>Gudang Tujuan</th>
                                <th>Deskripsi</th>
                                <th>Departemen</th>
                                <th>Status Transaksi</th>
                                <th>Jumlah Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$transfer->created_at->toDateString()}}</td>
                                <td>{{ $transfer->asal->kode_gudang}}</td>
                                <td>{{ $transfer->tujuan->kode_gudang}}</td>
                                <td> {{ $transfer->deskripsi }} </td>
                                <td> {{ $transfer->departemen }} </td>
                                <td>{{$transfer->status}}</td>
                                <td>{{count($transfer->items)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive-sm ">
                    <h5>Details : </h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Harga Barang (Rp)</th>
                                <th class="right">Satuan Unit</th>
                                <th class="center">Jumlah Barang Berpindah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transfer->items as $i => $item)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->nilai_barang}}</td>
                                <td>{{$item->unit->nama_satuan}}</td>
                                <td>{{$item->pivot->kuantitas}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
</div>
@endsection