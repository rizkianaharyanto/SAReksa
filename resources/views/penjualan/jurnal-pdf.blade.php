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
    
    <title>Jurnal PDF</title>
    <style type="text/css">
        .page{
            font: 12pt "Tahoma";
        }
    </style>
</head>
<body class="m-5">
    <div class="page">
	<center class="mb-4">
		<h5>Jurnal Transaksi Penjualan Reksa Karya</h4>
	</center>

	<table class="table table-sm table-striped table-bordered">
            <thead style="background-color: #212120; color:whitesmoke" >
                <tr>
                    <th>Tanggal</th>
                    <th>Transaksi</th>
                    <th>Akun</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurnals as $jurnal)
                    @foreach ($jurnal as $index)
                        <tr>
                            @if ($loop->first)
                            <td rowspan="{{$loop->count}}" >
                                    @if ($index->pengiriman_id !=null){{$index->pengiriman->tanggal}}
                                    @elseif ($index->retur_id !=null){{$index->retur->tanggal}}
                                    @elseif ($index->pembayaran_id !=null){{$index->pembayaran->tanggal}}
                                    @else -
                                    @endif
                            </td>
                            <td rowspan="{{$loop->count}}" >
                                    @if ($index->pengiriman_id !=null){{$index->pengiriman->kode_pengiriman}} 
                                    <br>- pengiriman barang
                                    <br>- faktur penjualan
                                    @elseif ($index->retur_id !=null){{$index->retur->kode_retur}} 
                                    <br>- retur penjualan
                                    @elseif ($index->pembayaran_id !=null){{$index->pembayaran->kode_pembayaran}} 
                                    <br>- pembayaran hutang
                                    @else -
                                    @endif
                            </td>
                            @endif
                            <td >
                                @if ($index->akun_id == 1) barang
                                @elseif ($index->akun_id == 2) barang belum ditagih
                                @elseif ($index->akun_id == 3) biaya lain
                                @elseif ($index->akun_id == 4) hutang
                                @elseif ($index->akun_id == 5) potongan penjualan
                                @elseif ($index->akun_id == 6) kas
                                @else -
                                @endif
                            </td>
                            <td >{{ $index->debit != 0 ? $index->debit : '-' }}</td>
                            <td >{{ $index->kredit != 0 ? $index->kredit : '-' }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="3">Total</td>
                    <td >{{$debit}}</td>
                    <td >{{$kredit}}</td>
                </tr>
            </tbody>
        </table>
        </div>
</body>
</html>