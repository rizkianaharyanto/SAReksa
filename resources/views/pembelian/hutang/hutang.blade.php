@extends('pembelian.template.table')

@section('judul', 'Hutang')

@section('halaman', 'Hutang')

@section('path')
<li><a href="#">Hutang</a></li>
<li class="active">Hutang</li>
@endsection

@section('thead')
<tr>
    <th>Pemasok</th>
    <th>Total Hutang</th>
    <th>Lunas</th>
    <th>Sisa Hutang</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pemasoks as $index => $pemasok)
<tr>
    <td>{{ $pemasok->nama_pemasok }}</td>
    <td>{{ $totals[$index]['total_hutang']}}</td>
    <td>{{ $lunass[$index]['lunas']}}</td>
    <td>{{ $sisas[$index]['sisa']}}</td>
    <td class="d-flex justify-content-between">
        <a href="/pembelian/hutangs/{{$pemasok->id}}">
            <button class="btn-outline-info">
                <i class="fas fa-info-circle"></i>
            </button>
        </a>
    </td>
</tr>
@endforeach
@endsection