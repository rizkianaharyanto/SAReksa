<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('vendor/stock/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('vendor/stock/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/stock/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/vector-map/jqvmap.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/jvectormap/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/fonts/flag-icon-css/flag-icon.min.css')}}">

    <title>Sistem Mangement Stock Reksa Karya</title>


</head>

<body>
    
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
                                <h3 class="text-dark mb-1">{$barang->pemasok->nama_pemasok}</h3>
                                <div>{$barang->pemasok->alamat_pemasok}</div>
                                <div>Email: {$barang->pemasok->email_pemasok}</div>
                                <div>Phone: {$barang->pemasok->telp_pemasok}</div>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="mb-3">Barang:</h5>
                                <h3 class="text-dark mb-1">{{$barang->nama_barang}}</h3>
                                <!-- <div>$barang->alamat_barang</div>
                                <div>Email: $barang->email_barang</div>
                                <div>Phone: $barang->telp_barang</div> -->
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
                                    @if($details ?? '')
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

    

</body>

</html>