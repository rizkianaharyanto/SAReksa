<!DOCTYPE html>
<html>

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
    <title>Kartu Hutang PDF</title>
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
                            <a class="pt-2 d-inline-block">Kartu Hutang</a>
                            <input type="hidden" name="id" value="{{$hutang->id}}">
                            <div class="float-right">
                                <h3 class="mb-0">{{$hutang->pemasok->nama_pemasok}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h5 class="mb-3">Transaksi:</h5>
                                    <h3 class="text-dark mb-1">{{$hutang->faktur->kode_faktur}}</h3>

                                    <!-- <div>$pembayaran->pemasok->alamat_pemasok</div>
                                            <div>Phone: $pembayaran->pemasok->telp_pemasok</div> -->
                                </div>
                                <!-- <div class="col-sm-6">
                                            <h5 class="mb-3">Faktur:</h5>
                                            <h3 class="text-dark mb-1">$faktur->kode_faktur</h3>                                            
                                            <div>Status: $pembayaran->status</div>
                                            <div>Phone: $gudang->no_telp</div>
                                        </div> -->
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tipe Transaksi</th>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Faktur (Hutang)</td>
                                            <td>{{$hutang->faktur->kode_faktur ? $hutang->faktur->kode_faktur  : '-' }}</td>
                                            <td>{{$hutang->faktur->tanggal ? $hutang->faktur->tanggal : '-' }}</td>
                                            <td></td>
                                            <td>{{ $hutang->total_hutang ? $hutang->total_hutang : '-' }}</td>
                                            <td></td>
                                        </tr>
                                        @foreach ($pembayarans as $index => $pembayaran)
                                        <tr>
                                            @if ($loop->first)
                                            <td rowspan="{{$loop->count}}">
                                                Pembayaran Hutang
                                            </td>
                                            @else
                                            @endif
                                            <td>{{$pembayaran->kode_pembayaran ? $pembayaran->kode_pembayaran  : '-' }}</td>
                                            <td>{{$pembayaran->tanggal ? $pembayaran->tanggal : '-' }}</td>
                                            <td>{{ $pembayaran->pivot->total ? $pembayaran->pivot->total : '-' }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @foreach ($returs as $index => $retur)
                                        <tr>
                                            @if ($loop->first)
                                            <td rowspan="{{$loop->count}}">
                                                Retur Pembelian
                                            </td>
                                            @else
                                            @endif
                                            <td>{{$retur->kode_retur ? $retur->kode_retur : '-' }}</td>
                                            <td>{{$retur->tanggal ? $retur->tanggal : '-' }}</td>
                                            <td>{{ $retur->total_harga ? $retur->total_harga : '-' }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td>{{ $lunas ?? '-' }}</td>
                                            <td>{{ $hutang->total_hutang ? $hutang->total_hutang : '-' }}</td>
                                            <td>{{ $sisa ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="card-footer bg-white">
                                <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>