@extends('pembelian.template.table')

@section('judul', 'Details')

@section('halaman', 'Kartu Hutang')

@section('path')
<li><a href="/pembelian/hutangs">Hutang Pemasok</a></li>
<li><a href="/pembelian/hutangs/{{$hutang->pemasok->id}}">Hutang Details</a></li>
<li class="active">Kartu Hutang</li>
@endsection

@section('isi')
<form action="/pembelian/hutang/cetak_pdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button class="btn btn-light"><a class="px-2" id="pdf" target="_blank">Export PDF</a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
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
                                    <td>@currency( $hutang->total_hutang)</td>
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
                                    <td>@currency( $pembayaran->pivot->total)</td>
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
                                    <td>@currency($retur->total_harga)</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td>@currency( $lunas)</td>
                                    <td>@currency( $hutang->total_hutang)</td>
                                    <td>@currency( $sisa)</td>
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
</form>
@endsection