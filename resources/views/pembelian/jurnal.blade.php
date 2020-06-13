@extends('pembelian.template.table')

@section('judul', 'Jurnal Khusus Pembelian')

@section('halaman', 'Jurnal Khusus Pembelian')

@section('isi')
<div style="overflow:auto; height: 80vh;" class="m-4">
    <div class="d-flex justify-content-end mx-5 p-2">
        <a class="px-2" href="">Export Excel | </a>
        <a class="px-2" href="/pembelian/jurnals/cetak_pdf" target="_blank">Export PDF | </a>
        <a class="px-2" href="">Print | </a>
    </div>
    <div style="background-color: white; color: black;" class="mx-5 p-3">
        <div class="d-flex justify-content-center m-3">
            <p>Reksa Karya</p>
            <p>Periode : 1</p>
        </div>
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
                                    @elseif ($index->pembayaran_id !=null){{$index->pembayaran->kode_pembayaran}}
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
    </div>
</div>
@endsection