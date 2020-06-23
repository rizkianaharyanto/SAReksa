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
    <title>Faktur PDF</title>
    <style type="text/css">
        .page{
            font: 12pt "Tahoma";
        }
    </style>
</head>
<body class="m-5">
    <div class="page">
	<center class="mb-4">
		<h5>Faktur</h4>
        <input type="hidden" name="id" value="{{$faktur->id}}">
    </center>
    <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode faktur : {{$faktur->kode_faktur}}</td>
                <td>Pemasok : {{$faktur->pelanggan->nama_pelanggan}}</td>
            </tr>
            <tr>
            <td>Sales : {{$faktur->penjual->nama_penjual}}</td>
                <td>Status : {{$faktur->status}}</td>
            </tr>
            <tr>
                                                        <td>Tanggal : {{$faktur->tanggal}}</td>
                                                    </tr>
            </tbody>
        </table>

	<table class="table table-striped table-bordered">
            <thead style="background-color: #212120; color:whitesmoke" >
                <tr>
                    <th>Nama Barang</th>
                    <th>QTY</th>
                    <th>Unit</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $index => $barang)
                    <tr>
                        <td>{{$barang->nama_barang ? $barang->nama_barang : '-' }}</td>
                        <td>{{$barang->pivot->jumlah_barang ? $barang->pivot->jumlah_barang : '-' }}</td>
                        <td>{{ $barang->pivot->unit ? $barang->pivot->unit : '-' }}</td>
                        <td>{{ $barang->pivot->harga ? $barang->pivot->harga : '-' }}</td>
                        <td>{{$total_harga[$index]}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right pr-3">Sub total</td>
                    <td id="subtotal">{{$subtotal}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right pr-3">diskon</td>
                    <td id="diskon">{{$diskon}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right pr-3">Biaya lain</td>
                    <td id="biaya_lain">{{$biaya_lain}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right pr-3">Uang Muka</td>
                    <td id="uang_muka">{{$uang_muka}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right pr-3">Total</td>
                    <td id="total_seluruh">{{$total_seluruh}}</td>
                </tr>
            </tbody>
        </table>
        </div>
</body>
</html>