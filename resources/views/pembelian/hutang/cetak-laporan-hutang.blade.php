<!DOCTYPE html>
<html>

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
    <title>Laporan Pemesanan PDF</title>
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
                                                <td>{{ $hutang->lunas ? $hutang->lunas : '-' }}</td>
                                                <td>{{ $hutang->sisa ? $hutang->sisa : '-' }}</td>
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
                                            <td>{{ $hutang->lunas ? $hutang->lunas : '-' }}</td>
                                            <td>{{ $hutang->sisa ? $hutang->sisa : '-' }}</td>
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
        </div>
    </div>
</body>

</html>