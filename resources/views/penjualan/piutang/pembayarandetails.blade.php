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
                                        <form method='POST' action="/penjualan/pembayarans/cetak_pdf">
                                            @csrf
                                            <div class="d-flex justify-content-end" style="margin-right:150px">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                                <input type="hidden" name="id" value="{{$pembayaran->id}}">
                                            </div>
                                            <!-- <div style="overflow:auto; height: 80vh;" class="m-2">
                                                <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <center class="mb-4">
                                                    <h5>Pembayaran</h4>
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
                                                                <th style="width: 80%">Kode Piutang</th>
                                                                <th style="width: 20%">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($piutangs as $index => $piutang)
                                                            <tr>
                                                                <td >{{$piutang->kode_piutang}}</td>
                                                                <td>{{$piutang->pivot->total}}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="1" class="text-right pr-3">Total</td>
                                                                <td id="subtotal">{{$pembayaran->total}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> -->
                                        </form>
                                        <div class="invoice-box">
                                            <table cellpadding="0" cellspacing="0">
                                                <tr class="top">
                                                    <td colspan="2">
                                                        <table>
                                                            <tr>
                                                                <td class="title">
                                                                    <img src="data:image/png;base64,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" style=" max-width:50%;">
                                                                </td>
                                                                
                                                                <td class="text-right">
                                                                    Pembayaran Piutang<br>
                                                                    {{$pembayaran->kode_pembayaran}}<br>
                                                                    Tanggal: {{$pembayaran->tanggal}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr class="information">
                                                    <td colspan="2">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    CV Reksa Karya<br>
                                                                    Jl. Letjen Suprapto RT02/02<br>
                                                                    Sokaraja Wetan, Banyumas                                                                </td>
                                        
                                                                <td class="text-right"style="background-color:">
                                                                {{$pembayaran->pelanggan->nama_pelanggan}}<br>
                                                                {{$pembayaran->pelanggan->alamat_pelanggan}}<br>
                                                                    {{$pembayaran->pelanggan->email_pelanggan}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr class="heading">
                                                    <td  style="width: 80%">
                                                        Kode Piutang
                                                    </td>
                                                    <td>
                                                        Total
                                                    </td>
                                                </tr>
                                                @foreach ($piutangs as $index => $piutang)
                                                <tr class="item">
                                                    <td>{{$piutang->kode_piutang}}</td>
                                                    <td>@currency($piutang->pivot->total)</td>
                                                                                                </td>
                                                </tr>
                                                @endforeach
                                                <tr class="total">
                                                    <td colspan="1" class="text-right pr-3">Total</td>
                                                    <td id="total_seluruh">@currency($pembayaran->total)</td>
                                                </tr>
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

@endsection