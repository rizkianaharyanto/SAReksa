@extends('penjualan.template.table', [
    'elementActive' => 'laporan'
])

@section('judul', 'Laporan')

@section('menu', 'Detail Piutang')

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
                                        <form action="/penjualan/laporans/piutangpdf">
                                        @csrf
                                            <div class="d-flex justify-content-end mx-5">
                                                <!-- <a class="px-2" href="">Export Excel | </a> -->
                                                <button><a class="px-2" id="pdf"  target="_blank">Export PDF | </a></button>
                                                <!-- <a class="px-2" href="">Print | </a> -->
                                            </div>
                                            <div style="overflow:auto; height: 80vh;" class="m-2">
                                                <div style="background-color: white; color: black;" class="mx-5 p-3">
                                                <input type="hidden" name="pelanggan_id" value='{{$id}}'>
                                                <center class="mb-4">
                                                    <h4>Detail Piutang Usaha</h4>
                                                    <h5>Pelanggan {{$nama}}</h5>
                                                    <h6>Total Piutang  Rp {{$total}}</h6>
                                                    <!-- <input type="hidden" name="id" value="{retur->id}}"> -->
                                                </center>
                                                <!-- <table class="table table-sm">
                                                        <tbody>
                                                        <tr>
                                                            <td>Kode retur : {retur->kode_retur}}</td>
                                                            <td>Pemasok : {retur->penjual->nama_penjual}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal : {retur->tanggal}}</td>
                                                            <td>Status : {retur->status}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table> -->

                                                    <table class="table table-striped table-bordered">
                                                            <thead style="background-color: #212120; color:whitesmoke" >
                                                                <tr>
                                                                    <th>Kode Piutang</th>
                                                                    <th>Transaksi</th>
                                                                    <th>Status</th>
                                                                    <th>Lunas</th>
                                                                    <th>Sisa</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($piutangs as $piutang)
                                                                <tr>
                                                                    <td>{{ $piutang->kode_piutang }}</td>
                                                                    <td>
                                                                        @if ($piutang->retur_id !=null){{$piutang->retur->kode_retur}}
                                                                        @elseif ($piutang->faktur_id !=null){{$piutang->faktur->kode_faktur}}
                                                                        @else -
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $piutang->status ? $piutang->status : '-' }}</td>
                                                                    <td>{{ $piutang->lunas ? $piutang->lunas : '-' }}</td>
                                                                    <td>{{ $piutang->sisa ? $piutang->sisa : '-' }}</td>  
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="3" class="text-right pr-3">TOTAL KESELURUHAN</td>
                                                                <td id="subtotal">{{$lunas}}</td>
                                                                <td id="subtotal">{{$sisa}}</td>
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
@endsection