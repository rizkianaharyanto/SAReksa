@extends('penjualan.template.table', [
    'elementActive' => 'piutang'
])
@section('judul', 'Piutang')

@section('menu', 'Piutang')

@section('thead')
<tr>
    <th>Pelanggan</th>
    <th>Total Piutang</th>
    <th>Lunas</th>
    <th>Sisa Piutang</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pelanggans as $index => $pelanggan)
<tr>
    <td>{{ $pelanggan->nama_pelanggan }}</td>
    <td>{{ $totals[$index]['total_piutang']}}</td>
    <td> {{ $lunass[$index]['lunas']}} </td>
    <td> {{ $sisas[$index]['sisa']}} </td>
    <td class="d-flex justify-content-between">
        <a href="/penjualan/piutangs/{{$pelanggan->id}}">
            <i onclick="" style='color: #212120' class="fas fa-info-circle" ></i>
        </a>
    </td>
</tr>
@endforeach
@endsection