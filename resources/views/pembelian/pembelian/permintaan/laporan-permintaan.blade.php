@extends('pembelian.template.table')

@section('judul', 'Laporan Permintaan')

@section('halaman', 'Laporan Permintaan')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Permintaan</a></li>
<li class="active">Laporan Permintaan</li>
@endsection

@section('isi')
<div class="mx-5 dt-buttons">
    <form class="d-flex" action="/pembelian/permintaans/laporanfilter" method="get">
        @csrf
        <select class="form-control m-2" name="pemasok_id" id="">
            <option value="">--- Pilih Pemasok ---</option>
            @foreach ($pemasoks as $pemasok)
            <option value="{{$pemasok->id}}">{{$pemasok->nama_pemasok}}</option>
            @endforeach
        </select>
        <input class="form-control m-2" type="date" name="start">
        <input class="form-control m-2" type="date" name="end">
        <button class="btn btn-outline-info m-2" type="submit">Filter</button>
    </form>
</div>

<form action="/pembelian/permintaans/laporanpdf">
    @csrf
    <input type="hidden" name="start" value="{{$start}}">
    <input type="hidden" name="end" value="{{$end}}">
    <div class="d-flex justify-content-end mx-5">
        <button class="btn btn-outline-info m-2 "><a class="px-2" id="pdf" target="_blank">Export PDF </a></button>
    </div>

    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    @if($supplier == null)
                    <a class="pt-2 d-inline-block">Semua Periode</a>
                    @else
                    <a class="pt-2 d-inline-block">Periode : {{$start ?? ''}} s.d. {{$end ?? ''}}</a>
                    @endif
                    <div class="float-right">
                        <h3 class="mb-0">Laporan Permintaan Penawaran Harga</h3>
                    </div>
                </div>
                <div class="card-body">
                    @if($supplier == null)
                    @foreach ($permintaans as $permintaan)
                    <div style="margin-bottom :10vh;">
                        <h5 class="mb-3" style="opacity: 80%">{{ $permintaan->kode_permintaan }} - {{ $permintaan->pemasok->nama_pemasok }}</h5>
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Diskon</th>
                                        <th>Biaya Lain</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $permintaan->tanggal }}</td>
                                        <td>{{ $permintaan->diskon_rp }}</td>
                                        <td>{{ $permintaan->biaya_lain }}</td>
                                        <td>{{ $permintaan->total_harga }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive-sm mb-5">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>QTY</th>
                                        <th>Unit</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permintaan->barangs as $index => $barang)
                                    <tr>
                                        <td>{{$barang->nama_barang ? $barang->nama_barang : '-' }}</td>
                                        <td>{{$barang->pivot->jumlah_barang ? $barang->pivot->jumlah_barang : '-' }}</td>
                                        <td>{{ $barang->pivot->unit ? $barang->pivot->unit : '-' }}</td>
                                        <td>{{ $barang->pivot->harga ? $barang->pivot->harga : '-' }}</td>
                                        <td>{{$barang->pivot->jumlah_barang * $barang->pivot->harga }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row mb-4">
                        <div class="col-sm-6 ">
                            <h5 class="mb-3">Pemasok:</h5>
                            <h3 class="text-dark mb-1">{{ $supplier->nama_pemasok }}</h3>
                            <div>Email : {{ $supplier->email_pemasok }}</div>
                            <div>Phone : {{ $supplier->telp_pemasok }}</div>
                        </div>
                    </div>

                    <input type="hidden" name="pemasok_id" value="{{$supplier->id}}">
                    @foreach ($permintaans as $permintaan)
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-3" style="opacity: 80%">Kode permintaan : {{ $permintaan->kode_permintaan }}</h5>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Diskon</th>
                                    <th>Biaya Lain</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $permintaan->tanggal }}</td>
                                    <td>{{ $permintaan->diskon_rp }}</td>
                                    <td>{{ $permintaan->biaya_lain }}</td>
                                    <td>{{ $permintaan->total_harga }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive-sm mb-5">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>QTY</th>
                                    <th>Unit</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permintaan->barangs as $index => $barang)
                                <tr>
                                    <td>{{$barang->nama_barang ? $barang->nama_barang : '-' }}</td>
                                    <td>{{$barang->pivot->jumlah_barang ? $barang->pivot->jumlah_barang : '-' }}</td>
                                    <td>{{ $barang->pivot->unit ? $barang->pivot->unit : '-' }}</td>
                                    <td>{{ $barang->pivot->harga ? $barang->pivot->harga : '-' }}</td>
                                    <td>{{$barang->pivot->jumlah_barang * $barang->pivot->harga }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>


@endsection