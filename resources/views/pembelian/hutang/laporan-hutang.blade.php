@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan Hutang')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Hutang</a></li>
<li class="active">Laporan Hutang</li>
@endsection

@section('isi')
<div class="mx-5 dt-buttons">
    <form class="d-flex" action="/pembelian/hutang/laporanfilter" method="get">
        @csrf
        <select class="form-control m-2" name="pemasok_id" id="">
            <option value="">--- Pilih Pemasok ---</option>
            @foreach ($allpemasok as $pemasok)
            <option value="{{$pemasok->id}}">{{$pemasok->nama_pemasok}}</option>
            @endforeach
        </select>
        <input class="form-control m-2" type="date" name="start">
        <input class="form-control m-2" type="date" name="end">
        <button class="btn btn-outline-info m-2" type="submit">Filter</button>
    </form>
</div>
<form action="/pembelian/hutang/laporanpdf">
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
                    <a class="pt-2 d-inline-block">Semua Pemasok</a>
                    @else
                    <a class="pt-2 d-inline-block">Periode : {{$start ?? ''}} s.d. {{$end ?? ''}}</a>
                    @endif
                    <div class="float-right">
                        <h3 class="mb-0">Laporan Hutang</h3>
                    </div>
                </div>
                <div class="card-body">
                    @if($supplier == null)
                    <div style="margin-bottom :10vh;">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Hutang</th>
                                        <th>Pemasok</th>
                                        <th>Tanggal</th>
                                        <th>Transaksi</th>
                                        <th>Status</th>
                                        <th>Lunas</th>
                                        <th>Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hutangs as $hutang)
                                    <tr>
                                        <td>{{ $hutang->kode_hutang }}</td>
                                        <td>{{ $hutang->pemasok->nama_pemasok }}</td>
                                        <td>{{ $hutang->tanggal }}</td>
                                        <td>
                                            @if ($hutang->retur_id !=null){{$hutang->retur->kode_retur}}
                                            @elseif ($hutang->faktur_id !=null){{$hutang->faktur->kode_faktur}}
                                            @else -
                                            @endif
                                        </td>
                                        <td>{{ $hutang->status ? $hutang->status : '-' }}</td>
                                        <td>@currency($hutang->lunas)</td>
                                        <td>@currency($hutang->sisa)</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="row mb-4">
                        <div class="col-sm-6 ">
                            <h5 class="mb-3">Pemasok:</h5>
                            <h3 class="text-dark mb-1">{{$supplier->nama_pemasok }}</h3>
                            <div>Email : {{$supplier->email_pemasok }}</div>
                            <div>Phone : {{$supplier->telp_pemasok }}</div>
                        </div>
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Hutang</th>
                                    <th>Tanggal</th>
                                    <th>Transaksi</th>
                                    <th>Status</th>
                                    <th>Lunas</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hutangs as $hutang)
                                <tr>
                                    <td>{{ $hutang->kode_hutang }}</td>
                                    <td>{{ $hutang->tanggal }}</td>
                                    <td>
                                        @if ($hutang->retur_id !=null){{$hutang->retur->kode_retur}}
                                        @elseif ($hutang->faktur_id !=null){{$hutang->faktur->kode_faktur}}
                                        @else -
                                        @endif
                                    </td>
                                    <td>{{ $hutang->status ? $hutang->status : '-' }}</td>
                                    <td>@currency($hutang->lunas)</td>
                                    <td>@currency($hutang->sisa)</td>
                                </tr>
                                @endforeach
                                <!-- <tr>
                                    <td colspan="3">Total</td>
                                    <td>$lunass}}</td>
                                    <td>$sisas}}</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="pemasok_id" value="{{$supplier->id}}">

                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection