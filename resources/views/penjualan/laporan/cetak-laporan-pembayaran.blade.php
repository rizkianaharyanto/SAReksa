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
    <title>Laporan Pembayaran Piutang PDF</title>
    <style type="text/css">
        .page{
            font: 12pt "Tahoma";
        }
    </style>
</head>
<body class="m-5">
    <div class="page">
	<center class="mb-4">
    <h4>Laporan Pembayaran</h4>
    <h5>Periode {{$bulan}} {{$tahun}}</h5>
        <!-- <input type="hidden" name="id" value="{permintaan->id}}"> -->
    </center>
    <!-- <table class="table table-sm">
            <tbody>
            <tr>
                <td>Kode permintaan : {permintaan->kode_permintaan}}</td>
                <td>Pemasok : {permintaan->pemasok->nama_pemasok}}</td>
            </tr>
            <tr>
                <td>Tanggal : {permintaan->tanggal}}</td>
                <td>Status : {permintaan->status}}</td>
            </tr>
            </tbody>
        </table> -->

	<table class="table table-striped table-bordered">
            <thead style="background-color: #212120; color:whitesmoke" >
                <tr>
                <th>Kode Pembayaran</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran  as $pembayaran)
                <tr>
                <td>{{ $pembayaran->kode_pembayaran }}</td>
                                                                    <td>{{ $pembayaran->pelanggan->nama_pelanggan }}</td>
                                                                    <td>{{ $pembayaran->tanggal }}</td>
                @if($pembayaran->status_posting == 'sudah posting')
                                                                    <td>Diterima</td>
                                                                    @elseif($pembayaran->status_posting == 'belum posting')
                                                                    <td>Belum Diterima</td>
                                                                    @endif
                <td>{{ $pembayaran->total }}</td>
                </tr>
                @endforeach
                <tr>
                                                                <td colspan="4" class="text-right pr-3">TOTAL KESELURUHAN</td>
                                                                <td id="subtotal">{{ $total }}</td>
                                                                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>