@extends('pembelian.template.table')

@section('judul', 'Laporan')

@section('halaman', 'Laporan retur')

@section('path')
<li><a href="#">Laporan & Jurnal</a></li>
<li><a href="#">Laporan Retur</a></li>
<li class="active">Laporan Retur Pembelian</li>
@endsection

@section('isi')

<div class=" mx-5">
    <form class="d-flex" action="/pembelian/retur/laporanfilter" method="get">
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

<form action="/pembelian/retur/laporanpdf">
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
                        <h3 class="mb-0">Laporan Retur</h3>
                    </div>
                </div>
                <div class="card-body">
                    @if($supplier == null)
                    <div style="margin-bottom :10vh;">
                        <div class="table-responsive-sm">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Retur</th>
                                        <th>pemasok</th>
                                        <th>Tanggal</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                        <!-- <th>Status</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returs as $retur)
                                    <tr>
                                        <td>{{ $retur->kode_retur }}</td>
                                        <td>{{ $retur->pemasok->nama_pemasok }}</td>
                                        <td>{{ $retur->tanggal }}</td>
                                        <td>@currency($retur->diskon_rp)</td>
                                        <td>@currency($retur->total_harga)</td>
                                        <!-- <td>{{ $retur->status !=null ? $retur->status  : '-' }}</td> -->
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
                            <h3 class="text-dark mb-1">{{ $supplier->nama_pemasok }}</h3>
                            <div>Email : {{ $supplier->email_pemasok }}</div>
                            <div>Phone : {{ $supplier->telp_pemasok }}</div>
                        </div>
                    </div>

                    <input type="hidden" name="pemasok_id" value="{{$supplier->id}}">

                    <div class="table-responsive-sm">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Retur</th>
                                    <th>Tanggal</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returs as $retur)
                                <tr>
                                    <td>{{ $retur->kode_retur }}</td>
                                    <td>{{ $retur->tanggal }}</td>
                                    <td>@currency($retur->diskon_rp)</td>
                                    <td>@currency($retur->total_harga)</td>
                                    <!-- <td>{{ $retur->status !=null ? $retur->status  : '-' }}</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>


@endsection