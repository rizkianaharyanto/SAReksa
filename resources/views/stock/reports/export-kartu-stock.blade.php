<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Kartu Stock</title>
    <style type="text/css">
        .page {
            font: 12pt "Tahoma";
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card row">
                    <div class="col">
                        <div class="card-header p-4">
                            <a class="pt-2 d-inline-block" href="/stok">SMS REKSA</a>

                            <div class="float-right">
                                <h3 class="mb-0">Kartu Stok</h3>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    @if($barang != null)
                                    <h5 class="mb-3">Pemasok:</h5>
                                    <h3 class="text-dark mb-1">{{$barang->pemasok->nama_pemasok}}</h3>
                                    <div>{{$barang->pemasok->alamat_pemasok}}</div>
                                    <div>Email: {{$barang->pemasok->email_pemasok}}</div>
                                    <div>Phone: {{$barang->pemasok->telp_pemasok}}</div>
                                </div>
                                <div class="col-sm-6 float-right">
                                    <h5 class="mb-3">Barang:</h5>
                                    <h3 class="text-dark mb-1">{{$barang->nama_barang}}</h3>
                                    @else
                                    @endif
                                </div>
                            </div>
                            @php
                            $i = 0;
                            @endphp
                            @if($barang == null)
                            @foreach ($ledgers as $ledger)
                            <div class="table-responsive-sm mb-5">
                                <h3>Barang : {{$ledger[0]->barangfk->nama_barang ?? ''}}</h3>
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center" rowspan="2">Tanggal</th>
                                            <th rowspan="2">Transaksi</th>
                                            <!-- <th rowspan="2">Gudang</th> -->
                                            <th class="center" colspan="2">Stok Masuk</th>
                                            <th class="center" colspan="2">Stok Keluar</th>
                                            <th class="center" rowspan="2">Sisa</th>
                                        </tr>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Nilai</th>
                                            <th>Qty</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ledger as $index)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($index->created_at)->format('d-m-Y')}}</td>
                                            <td>{{$index->kode_transaksi}}</td>
                                            <td>{{$index->qty_masuk}}</td>
                                            <td>{{$index->nilai_masuk}}</td>
                                            <td>{{$index->qty_keluar}}</td>
                                            <td>{{$index->nilai_keluar}}</td>
                                            <td>{{$index->sisa}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td>{{$total[$i]['qty_masuk_total']}}</td>
                                            <td>{{$total[$i]['nilai_masuk_total']}}</td>
                                            <td>{{$total[$i]['qty_keluar_total']}}</td>
                                            <td>{{$total[$i]['nilai_keluar_total']}}</td>
                                            <td>{{$total[$i]['sisa_total']}}</td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                            @else
                            @php
                            $i = 0;
                            @endphp
                            <div class="table-responsive-sm mb-5">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center" rowspan="2">Tanggal</th>
                                            <th rowspan="2">Transaksi</th>
                                            <!-- <th rowspan="2">Gudang</th> -->
                                            <th class="center" colspan="2">Stok Masuk</th>
                                            <th class="center" colspan="2">Stok Keluar</th>
                                            <th class="center" rowspan="2">Sisa</th>
                                        </tr>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Nilai</th>
                                            <th>Qty</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ledgers as $ledger)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($ledger->created_at)->format('d-m-Y')}}</td>
                                            <td>{{$ledger->kode_transaksi}}</td>
                                            <td>{{$ledger->qty_masuk}}</td>
                                            <td>{{$ledger->nilai_masuk}}</td>
                                            <td>{{$ledger->qty_keluar}}</td>
                                            <td>{{$ledger->nilai_keluar}}</td>
                                            <td>{{$ledger->sisa}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td>{{$total[$i]['qty_masuk_total']}}</td>
                                            <td>{{$total[$i]['nilai_masuk_total']}}</td>
                                            <td>{{$total[$i]['qty_keluar_total']}}</td>
                                            <td>{{$total[$i]['nilai_keluar_total']}}</td>
                                            <td>{{$total[$i]['sisa_total']}}</td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                            @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>