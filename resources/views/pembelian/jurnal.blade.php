@extends('pembelian.template.table')

@section('judul', 'Jurnal Khusus Pembelian')

@section('halaman', 'Jurnal Khusus Pembelian')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li class="active">Jurnal</li>
@endsection

@section('isi')
<div class=" mx-5">
    <form class="d-flex" action="/pembelian/jurnal/filter" method="get">
        @csrf
        <select class="form-control m-2" name="transaksi" id="">
            <option value="">--- Pilih Transaksi ---</option>
            <option value="Penerimaan Barang">Penerimaan Barang</option>
            <option value="Faktur">Faktur</option>
            <option value="Retur">Retur</option>
            <option value="Pembayaran Hutang">Pembayaran Hutang</option>
        </select>
        <button class="btn btn-outline-info m-2" type="submit">Filter</button>
    </form>
</div>

<form action="/pembelian/jurnal/cetak_pdf">
    @csrf
    <input type="hidden" name="transaksi" value="{{$transaksi}}">
    <div class="d-flex justify-content-end mx-5">
        <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf" target="_blank">Export PDF </a></button>
    </div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    @if($transaksi == null)
                    <a class="pt-2 d-inline-block">Semua Transaksi</a>
                    @else
                    <a class="pt-2 d-inline-block">Berdasarkan {{$transaksi ?? ''}} </a>
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
                                    <th scope="col" class="p-3" style="width: 20vw;">Tanggal</th>
                                    <th scope="col" class="p-3" style="width: 20vw;">Transaksi</th>
                                    <th scope="col" class="p-3" style="width: 20vw;">Akun</th>
                                    <th scope="col" class="p-3" style="width: 20vw;">Debit</th>
                                    <th scope="col" class="p-3" style="width: 20vw;">Kredit</th>
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
                                        @elseif ($index->akun_id == 7) uang muka
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
    @endsection