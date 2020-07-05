@extends('stock.reports.layout')

@section('title','Kartu Stock')

@section('isi')

<form action="/stok/reports/kartu-stock/export" class="d-flex justify-content-end" >
                @if($barang ?? '')
                <input type="hidden" name="id" value="{{$barang->id}}">
                <input type="hidden" name="tanggal" value="">
                <button type="submit" class="btn btn-primary my-2">Export PDF</button>
                @else
                @endif
            </form>
<div class="row">
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Filter</h5>
                <div class="card-body">
                    <form action="/stok/reports/kartu-stock/filter" class="form-group">
                            <label for="barang">Barang</label>
                            <select class="form-control" name="barang" id="barang">
                                <option value="">--- Pilih Barang ---</option>
                                @foreach ($barangs as $barangfilter)
                                <option value="{{$barangfilter->id}}">{{$barangfilter->nama_barang}}</option>
                                @endforeach
                            </select>
                            <label for="barang">Tanggal</label>
                            <input class="form-control" type="date" name="tanggal">
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
                            <h3 class="mb-0">Kartu Stok</h3>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">Pemasok:</h5>
                                <h3 class="text-dark mb-1">{{$barang->pemasok->nama_pemasok}}</h3>
                                <div>{{$barang->pemasok->alamat_pemasok}}</div>
                                <div>Email: {{$barang->pemasok->email_pemasok}}</div>
                                <div>Phone: {{$barang->pemasok->telp_pemasok}}</div>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="mb-3">Barang:</h5>
                                @if($barang ?? '')
                                <h3 class="text-dark mb-1">{{$barang->nama_barang}}</h3>
                                <!-- <div>$barang->alamat_barang</div>
                                <div>Email: $barang->email_barang</div>
                                <div>Phone: $barang->telp_barang</div> -->
                                @else
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center" rowspan="2">Tanggal</th>
                                        <th rowspan="2">Transaksi</th>
                                        <th rowspan="2">Gudang</th>
                                        <th class="center" colspan="2">Stok Masuk</th>
                                        <th class="center" colspan="2">Stok Keluar</th>
                                        <th class="center" rowspan="2">Sisa</th>
                                    </tr>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($details)
                                    @foreach ($details as  $detail)
                                        @foreach ($detail as $index)
                                            <tr>
                                                <td>{{$index->created_at ?? ''}}</td>
                                                <td>{{$index->kode_ref ?? ''}}</td>
                                                <td>{{$index->gudang_id ?? ''}}</td>
                                                <td>{{$index->pivot->kuantitas ?? ''}}</td>
                                                <td>{{$index->pivot->harga ?? ''}}</td>
                                                <td>{{$index->pivot->kuantitas ?? ''}}</td>
                                                <td>{{$index->pivot->harga ?? ''}}</td>
                                                <td>$sisa</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td colspan="3">Total</td>
                                        <td>$detail->qty</td>
                                        <td>$detail->harga</td>
                                        <td>$detail->qty</td>
                                        <td>$detail->harga</td>
                                        <td>$sisa</td>
                                    </tr>
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <!-- <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right">$28,809,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Discount (20%)</strong>
                                            </td>
                                            <td class="right">$5,761,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">VAT (10%)</strong>
                                            </td>
                                            <td class="right">$2,304,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">$20,744,00</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                    </div>
                </div>
        </div>
        <!-- ============================================================== -->
    </div>
@endsection