@extends('stock.reports.layout')

@section('title','Kartu Stock')

@section('isi')
<form action="/stok/reports/kartu-stock/export" class="d-flex justify-content-end">
    <input type="hidden" name="id" value="{{$barang->id ?? ''}}">
    <input type="hidden" name="start" value="{{$start}}">
    <input type="hidden" name="end" value="{{$end}}">
    <button type="submit" class="btn btn-primary my-2">Export PDF</button>
</form>
<div class="row">
    <!-- ============================================================== -->
    <div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Filter</h5>
            <div class="card-body">
                <form action="/stok/reports/kartu-stock/filter" class="form-group">
                    <label for="barang">Barang</label>
                    <select class="form-control" name="barang" id="barang">
                        <option value="">--- All Barang ---</option>
                        @foreach ($barangs as $barangfilter)
                        <option value="{{$barangfilter->id}}">{{$barangfilter->nama_barang}}</option>
                        @endforeach
                    </select>
                    <label for="barang">Tanggal</label>
                    <input class="form-control" type="date" name="start">
                    <label for="barang">Tanggal</label>
                    <input class="form-control" type="date" name="end">
                    <button type="submit" class="btn btn-block btn-primary my-3">Filter</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="/stok">SMS REKSA</a>

                <div class="float-right">
                    <h3 class="mb-0">Kartu Stok</h3>

                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        @if($barang != null)
                        <h5 class="mb-3">Pemasok:</h5>
                        <h3 class="text-dark mb-1">{{$barang->pemasok->nama_pemasok}}</h3>
                        <div>{{$barang->pemasok->alamat_pemasok}}</div>
                        <div>Email: {{$barang->pemasok->email_pemasok}}</div>
                        <div>Phone: {{$barang->pemasok->telp_pemasok}}</div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="mb-3">Barang:</h5>
                        <h3 class="text-dark mb-1">{{$barang->nama_barang}}</h3>
                        <!-- <div>$barang->alamat_barang</div>
                                <div>Email: $barang->email_barang</div>
                                <div>Phone: $barang->telp_barang</div> -->
                        @else
                        @endif
                    </div>
                </div>
                @foreach($alldetails as $puter => $details)
                <div class="table-responsive-sm mb-5">
                    @if($barang == null)
                    <h3>Barang : {{$barangs[$puter]->nama_barang ?? ''}}</h3>
                    @else
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center" rowspan="2">Tanggal</th>
                                <th rowspan="2">Transaksi</th>
                                <!-- <th rowspan="2">Gudang</th> -->
                                <th class="center" colspan="2">Stok Masuk</th>
                                <th class="center" colspan="2">Stok Keluar</th>
                                <th class="center" rowspan="2">Sisa</th>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <th>Nilai</th>
                                <th>Qty</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details['kartu'] as $detail)
                                @if ($loop->index == 0)
                                    @foreach ($detail as $index)
                                    <tr>
                                        <td>{{$index->created_at ?? ''}}</td>
                                        <td>{{$index->kode_ref ?? ''}}</td>
                                        <!-- <td>{{$index->gudang_id ?? ''}}</td> -->
                                        @if ($index->pivot->jumlah_fisik >= 0)
                                            <td class="qty_masuk">{{$index->pivot->jumlah_fisik ?? ''}}</td>
                                            <td class="nilai_masuk">{{$index->details[0]->nilai_barang ?? ''}}</td>
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td class="qty_keluar">{{$index->pivot->jumlah_fisik*-1 ?? ''}}</td>
                                            <td class="nilai_keluar">{{$index->details[0]->nilai_barang ?? ''}}</td>
                                        @endif
                                        <td class="sisa">{{$index->pivot->jumlah_fisik - $index->pivot->jumlah_tercatat}}</td>
                                    </tr>
                                    @endforeach
                                @elseif ($loop->index == 1)
                                    @foreach ($detail as $index)
                                    <tr>
                                        <td>{{$index->created_at ?? ''}}</td>
                                        <td>{{$index->kode_ref ?? ''}}</td>
                                        <!-- <td>{{$index->gudang_id ?? ''}}</td> -->
                                        <td class="qty_masuk">{{$index->pivot->kuantitas ?? ''}}</td>
                                        <td class="nilai_masuk">{{$index->items[0]->nilai_barang ?? ''}}</td>
                                        <td class="qty_keluar">{{$index->pivot->kuantitas ?? ''}}</td>
                                        <td class="nilai_keluar">{{$index->items[0]->nilai_barang ?? ''}}</td>
                                        <td class="sisa">0</td>
                                    </tr>
                                    @endforeach
                                @else
                                    @foreach ($detail as $index)
                                    <tr>
                                        <td>{{$index->created_at ?? ''}}</td>
                                        <td>{{$index->kode_ref ?? ''}}</td>
                                        <!-- <td>{{$index->gudang_id ?? ''}}</td> -->
                                        @if ($index->pivot->quantity_diff >= 0)
                                            <td class="qty_masuk">{{$index->pivot->quantity_diff ?? ''}}</td>
                                            <td class="nilai_masuk">{{$index->details[0]->nilai_barang ?? ''}}</td>
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td class="qty_keluar">{{$index->pivot->quantity_diff*-1 ?? ''}}</td>
                                            <td class="nilai_keluar">{{$index->details[0]->nilai_barang ?? ''}}</td>
                                        @endif
                                        <td class="sisa">{{$index->pivot->quantity_diff*-1}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="2">Total</td>
                                <td id="qty_masuk" name="qty_masuk">{{$details['qty_masuk']}}</td>
                                <td id="nilai_masuk" name="nilai_masuk">{{$details['nilai_masuk']}}</td>
                                <td id="qty_keluar" name="qty_keluar">{{$details['qty_keluar']}}</td>
                                <td id="nilai_keluar" name="nilai_keluar">{{$details['nilai_keluar']}}</td>
                                <td id="sisa" name="sisa">{{$details['sisa']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <!-- <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right">$28,809,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Discount (20%)</strong>
                                            </td>
                                            <td class="right">$5,761,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">VAT (10%)</strong>
                                            </td>
                                            <td class="right">$2,304,00</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">$20,744,00</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> -->
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
</div>
@endsection
@section('scripts')
@parent
<!-- <script>
    console.log('mulai')
    //qty masuk
        var arr = document.querySelectorAll('.qty_masuk');
        var qty_masuk = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseInt(arr[i].innerHTML))
                qty_masuk += parseInt(arr[i].innerHTML);
        }
        $('#qty_masuk').html(qty_masuk)
        $('#req_qty_masuk').val(qty_masuk)
    //nilai masuk
        var arr2 = document.querySelectorAll('.nilai_masuk');
        var nilai_masuk = 0;
        for (var i = 0; i < arr2.length; i++) {
            if (parseInt(arr2[i].innerHTML))
                nilai_masuk += parseInt(arr2[i].innerHTML);
        }
        $('#nilai_masuk').html(nilai_masuk)
        $('#req_nilai_masuk').val(nilai_masuk)
    //qty keluar
        var arr3 = document.querySelectorAll('.qty_keluar');
        var qty_keluar = 0;
        for (var i = 0; i < arr3.length; i++) {
            if (parseInt(arr3[i].innerHTML))
                qty_keluar += parseInt(arr3[i].innerHTML);
        }
        $('#qty_keluar').html(qty_keluar)
        $('#req_qty_keluar').val(qty_keluar)
    //nilai keluar
        var arr4 = document.querySelectorAll('.nilai_keluar');
        var nilai_keluar = 0;
        for (var i = 0; i < arr4.length; i++) {
            if (parseInt(arr4[i].innerHTML))
                nilai_keluar += parseInt(arr4[i].innerHTML);
        }
        $('#nilai_keluar').html(nilai_keluar)
        $('#req_nilai_keluar').val(nilai_keluar)
    //sisa
        var arr5 = document.querySelectorAll('.sisa');
        var sisa = 0;
        for (var i = 0; i < arr5.length; i++) {
            if (parseInt(arr5[i].innerHTML))
                sisa += parseInt(arr5[i].innerHTML);
        }
        $('#sisa').html(sisa)
        $('#req_sisa').val(sisa)
</script> -->
@endsection