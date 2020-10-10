<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Penyesuaian Stock</title>
    <style type="text/css">
        .page {
            font: 12pt "Tahoma";
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card row">
                    <div class="col">
                        <div class="card-header p-4">
                            <a class="pt-2 d-inline-block" href="/stok">SMS REKSA</a>

                            <div class="float-right">
                                <h3 class="mb-0">Laporan Penyesuaian</h3>

                            </div>
                        </div>
                        <div class="card-body">
                            <center>
                                <div class="row mb-4">

                                    @if($start != null)
                                    <div class="col">
                                        <h5 class="mb-3">Periode:</h5>
                                        <h3 class="text-dark mb-1">{{$start}} s.d {{$end}}</h3>
                                    </div>
                                    @else
                                    @endif
                                </div>
                            </center>
                            @foreach ($stockAdjustments as $i => $stockAdjustment)
                            <div class="table-responsive-sm mb-2 mt-5">
                                <div class="d-flex justify-content-between">
                                    <h3>Kode : {{ $stockAdjustment->kode_ref }} </h3>
                                    <h3 class="float-right">Gudang : {{ $stockAdjustment->gudang->kode_gudang}}</h3>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah Barang</th>
                                            <th>Status</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> {{ $stockAdjustment->created_at->toDateString()}}</td>
                                            <td> {{ $stockAdjustment->deskripsi }} </td>
                                            <td> {{ count($stockAdjustment->details) }} </td>
                                            <td> {{$stockAdjustment->status}}</td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive-sm ">
                                <h5>Details : </h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th>Harga Barang (Rp)</th>
                                            <th class="right">Satuan Unit</th>
                                            <th class="center">Perbedaan Kuantitas</th>
                                            <th>Debit (Akun Barang)</th>
                                            <th>Kredit(Akun Barang)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stockAdjustment->details as $i => $item)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>{{$item->nama_barang}}</td>
                                            <td>{{$item->nilai_barang}}</td>
                                            <td>{{$item->unit->nama_satuan}}</td>
                                            <td>
                                                @if($item->pivot->quantity_diff > 0) + {{$item->pivot->quantity_diff}}
                                                @elseif($item->pivot->quantity_diff < 0) {{$item->pivot->quantity_diff}} @else 0 @endif </td> <td>
                                                    @if($item->pivot->selisih * $item->nilai_barang >= 0){{$item->pivot->selisih * $item->nilai_barang}}
                                                    @endif
                                            </td>
                                            <td>
                                                @if($item->pivot->selisih * $item->nilai_barang < 0){{$item->pivot->selisih * $item->nilai_barang}} @else - @endif </td> </tr> @endforeach </tbody> </table> </div> @endforeach </div> <div class="card-footer bg-white">
                                                    <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>