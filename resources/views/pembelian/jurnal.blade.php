@extends('pembelian.template.table')

@section('judul', 'Jurnal Khusus Pembelian')

@section('halaman', 'Jurnal Khusus Pembelian')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li class="active">Jurnal</li>
@endsection

@section('isi')
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <a class="btn btn-outline-info" id="pdf" href="/pembelian/jurnals/cetak_pdf" target="_blank">Export PDF</a>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
<div  class="m-2">
    <div style="background-color: white; color: black;" class="mx-5 p-3">
        <center>
        <h5>Jurnal Transaksi Pembelian Reksa Karya</h4>
            <p>Periode : 1</p>
        </center>
        <table class="table table-sm table-bordered ">
            <thead >
                <tr>
                    <th scope="col" class="p-3" style="width: 20vw;">Tanggal</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Transaksi</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Akun</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Debit</th>
                    <th scope="col" class="p-3" style="width: 20vw;">Kredit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurnals as $jurnal)
                    @foreach ($jurnal as $index)
                        @if($index->debit == 0 && $index->kredit == 0)
                        <tr>
                        </tr>
                        @else
                        <tr>
                            @if ($loop->first)
                            <td rowspan="{{$loop->count}}" >
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
        </table>
    </div>
</div>

@endsection