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
                                    <div class=" mx-5 dt-buttons d-flex justify-content-center" style="background-color:">
                                        <form class="d-flex" action="/penjualan/jurnals/filter" method="POST">
                                            @csrf
                                                <div class="col-md-6" >
                                                    <label for="nama_penjual">Bulan</label>
                                                    <select style="height: 30px" class="form-control" onchange="isi(this)" id="bulan" name="bulan" >
                                                        <option value="" disabled selected hidden>Pilih Bulan</option><option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option>                    <option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                                                    </select>             
                                                    <!-- <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder=""> -->
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nama_penjual">Tahun</label>
                                                    <input type="number" class="form-control" id="tahun" min="0" max="2022" name="tahun" placeholder="Tahun" required/>
                                                </div>
                                                <div class="col-md-6">
                                                <button class="btn btn-outline " style="background-color:#212120; color:white" type="submit">Filter</button>
                                                </div>

                                        </form>
                                        <!-- <a class="px-2" href="">Export Excel | </a> -->
                                        <!-- <a class="px-2" href="">Print | </a> -->
                                        <!-- <button class="dt-button button-html5 button-excel" aria-controls="example" tabindex="0"><span>Excel</span></button>
                                        <button class="dt-button button-html5 button-pdf" aria-controls="example" tabindex="0"><span>PDF</span></button>
                                        <button class="dt-button button-html5 button-print" aria-controls="example" tabindex="0"><span>Print</span></button> -->
                                    </div>
                                        <div class="d-flex justify-content-end mx-5">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                @if(Route::currentRouteAction() == 'App\Http\Controllers\Penjualan\JurnalsController@index')
                                                <button><a href="/penjualan/jurnals/cetak_pdf" class="px-2" id="pdf" style="color:black" target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                                @else
                                                <form action="/penjualan/jurnals/filterpdf">
                                                @csrf
                                                    <input type="hidden" name="bulan_angka" value='{{$bulanangka}}'>
                                                    <input type="hidden" name="tahun" value='{{$tahun}}'>
                                                    <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                </form>
                                                @endif
                                        </div>
                                        
                                        <div style="overflow:auto; height: 80vh;" class="m-2">
                                            <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <center>
                                                <h5>Jurnal Transaksi Penjualan Reksa Karya</h5>
                                                <h5>{{$periode ?? ''}} {{$bulan ?? ''}} {{$tahun ?? ''}}</h5>
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
                                                                        @elseif ($index->akun_id == 4) piutang
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