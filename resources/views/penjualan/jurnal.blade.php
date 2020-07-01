@extends('penjualan.template.template', [
    'elementActive' => 'jurnal'
])

@section('judul', 'Jurnal Khusus Penjualan')

@section('menu', 'Jurnal Khusus Penjualan')

@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-end mx-5">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                <button href="/penjualan/jurnals/cetak_pdf"><a href="/penjualan/jurnals/cetak_pdf" class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                        </div>
                                        <div style="overflow:auto; height: 80vh;" class="m-2">
                                            <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <center>
                                                <h5>Jurnal Transaksi Penjualan Reksa Karya</h4>
                                                    <p>Periode : 1</p>
                                                </center>
                                                <table class="table table-sm table-striped table-bordered">
                                                    <thead style="background-color: #212120; color:whitesmoke">
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
                                                                <tr>
                                                                    @if ($loop->first)
                                                                    <td rowspan="{{$loop->count}}" >
                                                                            @if ($index->pengiriman_id !=null){{$index->pengiriman->tanggal}}
                                                                            @elseif ($index->faktur_id !=null){{$index->faktur->tanggal}}

                                                                            @elseif ($index->retur_id !=null){{$index->retur->tanggal}}
                                                                            @elseif ($index->pembayaran_id !=null){{$index->pembayaran->tanggal}}
                                                                            @else -
                                                                            @endif
                                                                    </td>
                                                                    <td rowspan="{{$loop->count}}" class="p-2">
                                                                            @if ($index->pengiriman_id !=null){{$index->pengiriman->kode_pengiriman}} - pengiriman barang
                                                                            @elseif ($index->faktur_id !=null){{$index->faktur->kode_faktur}} - faktur penjualan
                                                                            @elseif ($index->retur_id !=null){{$index->retur->kode_retur}} - retur penjualan
                                                                            @elseif ($index->pembayaran_id !=null){{$index->pembayaran->kode_pembayaran}} - pembayaran piutang
                                                                            @else -
                                                                            @endif
                                                                    </td>
                                                                    @endif
                                                                    <td class="p-2">
                                                                        @if ($index->akun_id == 1) barang
                                                                        @elseif ($index->akun_id == 2) barang belum ditagih
                                                                        @elseif ($index->akun_id == 3) biaya lain
                                                                        @elseif ($index->akun_id == 4) hutang
                                                                        @elseif ($index->akun_id == 5) potongan penjualan
                                                                        @elseif ($index->akun_id == 6) kas
                                                                        @else -
                                                                        @endif
                                                                    </td>
                                                                    <td class="p-2" name="debit[]">{{ $index->debit != 0 ? $index->debit : '0' }}</td>
                                                                    <td class="p-2" name="kredit[]">{{ $index->kredit != 0 ? $index->kredit : '0' }}</td>
                                                                </tr>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection