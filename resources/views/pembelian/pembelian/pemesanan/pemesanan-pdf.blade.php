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
    <title>Pemesanan PDF</title>
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
                            <a class="pt-2 d-inline-block">Pemesanan Pembelian</a>
                            <input type="hidden" name="id" value="{{$pemesanan->id}}">
                            <div class="float-right">
                                <h3 class="mb-0">{{$pemesanan->kode_pemesanan}}</h3>
                                {{$pemesanan->tanggal}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h5 class="mb-3">Pemasok:</h5>
                                    <h3 class="text-dark mb-1">{{$pemesanan->pemasok->nama_pemasok}}</h3>

                                    <div>{{$pemesanan->pemasok->alamat_pemasok}}</div>
                                    <div>Phone: {{$pemesanan->pemasok->telp_pemasok}}</div>
                                </div>
                                <div class="col-sm-6 float-right">
                                    <h5 class="mb-3">Gudang:</h5>
                                    <h3 class="text-dark mb-1">{{$gudang->kode_gudang}}</h3>
                                    <div>{{$gudang->alamat}}</div>
                                    <div>Phone: {{$gudang->no_telp}}</div>
                                </div>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
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
                                            <td>@currency($barang->pivot->harga)</td>
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
                                                    <strong class="text-dark">Diskon</strong>
                                                </td>
                                                <td class="right">@currency($diskon)</td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <strong class="text-dark">Biaya Lain</strong>
                                                </td>
                                                <td class="right">@currency($biaya_lain)</td>
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
        </div>
    </div>
</body>

</html>