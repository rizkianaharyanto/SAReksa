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
    <title>Jurnal PDF</title>
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
                            @if($transaksi == null)
                            <a class="pt-2 d-inline-block">Semua Transaksi</a>
                            @else
                            <p class="pt-2 d-inline-block">Berdasarkan </p>
                            <p> {{$transaksi ?? ''}} </p>
                            @endif
                            <div class="float-right">
                                <h3 class="mb-0">Jurnal Khusus Transaksi Pembelian</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Transaksi</th>
                                            <th>Akun</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                        </tr>
                                    </thead>
                                    @if($transaksi == null)
                                    <tbody>
                                        @foreach ($jurnals as $jurnal)
                                        @foreach ($jurnal as $index)
                                        @if($index->debit == 0 && $index->kredit == 0)
                                        <tr>
                                        </tr>
                                        @else
                                        <tr>
                                            @if ($loop->first)
                                            <td rowspan="{{$loop->count}}">
                                                @if ($index->penerimaan_id !=null){{$index->penerimaan->tanggal}}
                                                @elseif ($index->faktur_id !=null){{$index->faktur->tanggal}}
                                                @elseif ($index->retur_id !=null){{$index->retur->tanggal}}
                                                @elseif ($index->pembayaran_id !=null){{$index->pembayaran->tanggal}}
                                                @else -
                                                @endif
                                            </td>
                                            <td rowspan="{{$loop->count}}" class="p-2">
                                                @if ($index->penerimaan_id !=null){{$index->penerimaan->kode_penerimaan}} - penerimaan barang
                                                @elseif ($index->faktur_id !=null){{$index->faktur->kode_faktur}} - faktur pembelian
                                                @elseif ($index->retur_id !=null){{$index->retur->kode_retur}} - retur pembelian
                                                @elseif ($index->pembayaran_id !=null){{$index->pembayaran->kode_pembayaran}} - pembayaran hutang
                                                @else -
                                                @endif
                                            </td>
                                            @endif
                                            <td class="p-2">
                                                @if ($index->akun_id == 1) barang
                                                @elseif ($index->akun_id == 2) barang belum ditagih
                                                @elseif ($index->akun_id == 3) biaya lain
                                                @elseif ($index->akun_id == 4) hutang
                                                @elseif ($index->akun_id == 5) potongan pembelian
                                                @elseif ($index->akun_id == 6) kas
                                                @else -
                                                @endif
                                            </td>
                                            <td class="p-2" name="debit[]">{{ $index->debit != 0 ? $index->debit : '-' }}</td>
                                            <td class="p-2" name="kredit[]">{{ $index->kredit != 0 ? $index->kredit : '-' }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endforeach
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td>{{$debit}}</td>
                                            <td>{{$kredit}}</td>
                                        </tr>
                                    </tbody>
                                    @else
                                    <tbody>
                                        @foreach ($jurnals as $jurnal)
                                        @if($jurnal->debit == 0 && $jurnal->kredit == 0)
                                        <tr>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>
                                                @if ($jurnal->penerimaan_id !=null){{$jurnal->penerimaan->tanggal}}
                                                @elseif ($jurnal->faktur_id !=null){{$jurnal->faktur->tanggal}}
                                                @elseif ($jurnal->retur_id !=null){{$jurnal->retur->tanggal}}
                                                @elseif ($jurnal->pembayaran_id !=null){{$jurnal->pembayaran->tanggal}}
                                                @else -
                                                @endif
                                            </td>
                                            <td class="p-2">
                                                @if ($jurnal->penerimaan_id !=null){{$jurnal->penerimaan->kode_penerimaan}} - penerimaan barang
                                                @elseif ($jurnal->faktur_id !=null){{$jurnal->faktur->kode_faktur}} - faktur pembelian
                                                @elseif ($jurnal->retur_id !=null){{$jurnal->retur->kode_retur}} - retur pembelian
                                                @elseif ($jurnal->pembayaran_id !=null){{$jurnal->pembayaran->kode_pembayaran}} - pembayaran hutang
                                                @else -
                                                @endif
                                            </td>
                                            <td class="p-2">
                                                @if ($jurnal->akun_id == 1) barang
                                                @elseif ($jurnal->akun_id == 2) barang belum ditagih
                                                @elseif ($jurnal->akun_id == 3) biaya lain
                                                @elseif ($jurnal->akun_id == 4) hutang
                                                @elseif ($jurnal->akun_id == 5) potongan pembelian
                                                @elseif ($jurnal->akun_id == 6) kas
                                                @else -
                                                @endif
                                            </td>
                                            <td class="p-2" name="debit[]">{{ $jurnal->debit != 0 ? $jurnal->debit : '-' }}</td>
                                            <td class="p-2" name="kredit[]">{{ $jurnal->kredit != 0 ? $jurnal->kredit : '-' }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td>{{$debit}}</td>
                                            <td>{{$kredit}}</td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>