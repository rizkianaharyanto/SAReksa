<!DOCTYPE html>
<html>
<head>
    <title>Jurnal PDF</title>
</head>
<body>
	<center>
		<h5>Reksa Karya</h4>
		<h6>Periode : 1</h5>
	</center>

	<table class="table table-bordered">
            <thead style="background-color: #00BFA6; color:whitesmoke">
                <tr>
                    <th scope="col" class="p-3" style="width: 20vw;">No. Transaksi</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Akun</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Debit</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Kredit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurnals as $jurnal)
                    @foreach ($jurnal as $index)
                        <tr>
                            @if ($loop->first)
                            <td rowspan="{{$loop->count}}" class="p-2">
                                    @if ($index->penerimaan_id !=null){{$index->penerimaan->kode_penerimaan}}
                                    @elseif ($index->faktur_id !=null){{$index->faktur->kode_faktur}}
                                    @elseif ($index->retur_id !=null){{$index->retur->kode_retur}}
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
                                @else -
                                @endif
                            </td>
                            <td class="p-2">{{ $index->debit != 0 ? $index->debit : '-' }}</td>
                            <td class="p-2">{{ $index->kredit != 0 ? $index->kredit : '-' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

</body>
</html>