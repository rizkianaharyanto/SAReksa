@extends('pembelian.template.table')

@section('judul', 'Details')

@section('halaman', 'Details Pembayaran')

@section('path')
<li><a href="#">Transaksi</a></li>
<li><a href="/pembelian/pembayarans">Pembayaran Hutang</a></li>
<li class="active">Detail Pembayaran</li>
@endsection

@section('isi')
<form action="/pembelian/pembayarans/cetak_pdf">
    <div class="d-flex justify-content-end mx-5">
        <!-- <a class="px-2" href="">Export Excel | </a> -->
        <button class="btn btn-light"><a class="px-2" id="pdf"  target="_blank">Export PDF</a></button>
        <!-- <a class="px-2" href="">Print | </a> -->
    </div>
                    <div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header p-4">
                                     <a class="pt-2 d-inline-block">Pembayaran Hutang</a>
                                    <input type="hidden" name="id" value="{{$pembayaran->id}}">
                                    <div class="float-right"> <h3 class="mb-0">{{$pembayaran->kode_pembayaran}}</h3>
                                    {{$pembayaran->tanggal}}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <h5 class="mb-3">Pemasok:</h5>                                            
                                            <h3 class="text-dark mb-1">{{$pembayaran->pemasok->nama_pemasok}}</h3>
                                         
                                            <div>{{$pembayaran->pemasok->alamat_pemasok}}</div>
                                            <div>Phone: {{$pembayaran->pemasok->telp_pemasok}}</div>
                                        </div>
                                        <!-- <div class="col-sm-6">
                                            <h5 class="mb-3">Faktur:</h5>
                                            <h3 class="text-dark mb-1">$faktur->kode_faktur</h3>                                            
                                            <div>Status: {{$pembayaran->status}}</div>
                                            <div>Phone: $gudang->no_telp</div>
                                        </div> -->
                                    </div>
                                    <div class="table-responsive-sm">
                                        <table class="table table-striped table-bordered">
                                            <thead  >
                                                <tr>
                                                    <th>Kode Hutang</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($hutangs as $index => $hutang)
                                                    <tr>
                                                        <td>{{$hutang->kode_hutang ? $hutang->kode_hutang : '-' }}</td>
                                                        <td>{{$hutang->faktur->kode_faktur ? $hutang->faktur->kode_faktur : '-' }}</td>
                                                        <td>{{ $hutang->total_hutang ? $hutang->total_hutang : '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-5">
                                        </div>
                                        <div class="col-lg-4 col-sm-5 ml-auto">
                                            <table class="table table-clear">
                                                <tbody>
                                                    <tr>
                                                        <td class="left">
                                                            <strong class="text-dark">Total</strong>
                                                        </td>
                                                        <td class="right">
                                                            <strong class="text-dark">{{$total_seluruh}}</strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card-footer bg-white">
                                    <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
</form>
@endsection