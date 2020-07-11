@extends('stock.standard-layout')
@section('main-content')

<div class="alert"></div>
<div class="row">
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="index.html">SMS REKSA</a>

                <div class="float-right">
                    <h3 class="mb-0">Invoice {{$stockAdjustment->kode_ref}}</h3>
                    {{$stockAdjustment->created_at}}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">Gudang:</h5>
                        <h3 class="text-dark mb-1">{{$stockAdjustment->gudang->kode_gudang}}</h3>

                        <div>{{$stockAdjustment->gudang->alamat}}</div>
                        <div>{{$stockAdjustment->gudang->no_telp}}</div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mb-3">Keterangan:</h5>
                        <h3 class="text-dark mb-1">Penanggung Jawab: <br> Anthony K. Friel</h3>
                        <div>{{$stockAdjustment->deskripsi}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th>Harga Barang (Rp)</th>
                                <th class="right">Satuan Unit</th>
                                <th class="center">Perbedaan Kuantitas</th>
                                <th>Debit (Akun Barang)</th>
                                <th>Kredit(Akun Barang)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockAdjustment->details as $i => $item)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->nilai_barang}}</td>
                                <td>{{$item->unit->nama_satuan}}</td>
                                <td>@if($item->pivot->quantity_diff > 0)
                                    + {{$item->pivot->quantity_diff}}
                                    @elseif($item->pivot->quantity_diff < 0) + {{$item->pivot->quantity_diff}} @else 0
                                        @endif </td> <td>@if($item->pivot->selisih * $item->nilai_barang >= 0)
                                        {{$item->pivot->selisih * $item->nilai_barang}}
                                        @endif
                                </td>
                                <td>@if($item->pivot->selisih * $item->nilai_barang < 0)
                                        {{$item->pivot->selisih * $item->nilai_barang}} @else - @endif </td> </tr>
                                        @endforeach </tbody> </table> </div> <div class="row">
                                        <div class="col-lg-4 col-sm-5">
                                        </div>
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total Barang</strong>
                                                        </td>
                                                        <td class="right">{{count($stockAdjustment->details)}}</td>
                                                    </tr>
                                                    {{-- <tr>
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
                                                    </tr> --}}
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