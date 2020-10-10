<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Session::get('title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
</head>

<body>
<style type="text/css">

        body {
            width:100%;
        }
	</style>
	<div>
		<h4 style="text-align:center; font-weight:bold">Slip Gaji</h4>
	</div>
	<table>
		<tr>
			<td>
			</td>
		</tr>
	</table>
	<table class="mt-5">
		<tr>
			<td style="width:100px">Nama</td>
			<td style="width:320px">: {{ $penggajian->pegawai->nama}}</td>
			<td style="width:130px">Periode</td>
			<td>: {{ \Carbon\Carbon::parse($penggajian->tanggal)->format('F Y') }}</td>
		</tr>
		<tr>
			<td>Jabatan</td>
			@php
				$count = count($penggajian->pegawai->jabatans);
			@endphp
			@foreach( $penggajian->pegawai->jabatans as $index => $jbt )
				
				@if( $count-1 == $index )
				<td>: {{ $jbt->nama_jabatan }}</td>
				
				@endif
			@endforeach
			<td>Tanggal cetak</td>
			<td>: {{ $tanggal }}</td>
		</tr>
	</table>

	<table class='table table-bordered mt-3'>
		<thead>
			<tr>
				<th>Jenis Gaji</th>
				<th style="width: 150px">Nominal</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					@foreach( $penggajian->tunjangan as $index => $tunjangan )
                    	{{ $tunjangan->nama_tunjangan }}<br>
					@endforeach
				</td>
				<td>
					@foreach( $penggajian->tunjangan as $index => $tunjangan )
						<div> <div style="text-align: right; display: inline-block;">Rp</div> <div style="text-align: right; display: inline-block; width:100px">{{ number_format($tunjangan->pivot->jumlah_tunjangan) }}</div> </div>
					@endforeach
				</td>
			</tr>
			<tr>
				<td style="text-align: right; font-weight: bold;">
					Total Gaji
						<br>
					Pajak
						<br>
					Total diterima
				</td>
				<td>
					<div> <div style="text-align: right; display: inline-block; font-weight:bold">Rp</div> <div style="text-align: right; display: inline-block; width:100px; font-weight:bold">{{ number_format($penggajian->jumlah) }}</div> </div>
					<div> <div style="text-align: right; display: inline-block; font-weight:bold">Rp</div> <div style="text-align: right; display: inline-block; width:100px; font-weight:bold">{{ number_format($penggajian->pajak) }}</div> </div>
					<div> <div style="text-align: right; display: inline-block; font-weight:bold">Rp</div> <div style="text-align: right; display: inline-block; width:100px; font-weight:bold">{{ number_format($penggajian->gaji) }}</div> </div>
				</td>
			</tr>
		</tbody>
	</table>


</body>

</html>