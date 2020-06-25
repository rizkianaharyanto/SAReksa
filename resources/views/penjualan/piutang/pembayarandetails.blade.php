@extends('penjualan.template.table', [
    'elementActive' => 'pembayaran'
])
@section('judul', 'Detail Pembayaran')

@section('menu', 'Detail Pembayaran')
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
                                        <form action="/penjualan/pembayarans/cetak_pdf">
                                            <div class="d-flex justify-content-end mx-5">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                            </div>
                                            <div style="overflow:auto; height: 80vh;" class="m-2">
                                                <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <center class="mb-4">
                                                    <h5>Pembayaran</h4>
                                                    <input type="hidden" name="id" value="{{$pembayaran->id}}">
                                                </center>
                                                <table class="table table-sm">
                                                        <tbody>
                                                        <tr>
                                                            <td>Kode Pembayaran : {{$pembayaran->kode_pembayaran}}</td>
                                                            <td>Pelanggan : {{$pembayaran->pelanggan->nama_pelanggan}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal : {{$pembayaran->tanggal}}</td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                </table>
                                                <table class="table table-striped table-bordered">
                                                        <thead style="background-color: #212120; color:whitesmoke" >
                                                            <tr>
                                                                <th>Kode Piutang</th>
                                                                <th>Tanggal Piutang</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($piutangs as $index => $piutang)
                                                            <tr>
                                                                <td>{{$piutang->kode_piutang}}</td>
                                                                <td>{{ $piutang->pivot->tanggal ? $piutang->pivot->tanggal : '-' }}</td>
                                                                <td>{{$piutang->pivot->total}}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="2" class="text-right pr-3">Total</td>
                                                                <td id="subtotal">{{$pembayaran->total}}</td>
                                                            </tr>
                                                
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
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