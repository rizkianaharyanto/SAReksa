@extends('pembelian.template.table')

@section('judul', 'Hutang')

@section('halaman', 'Hutang')

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
            <i onclick="" class="fas fa-info-circle"></i>
        </a>
    </td>
</tr>
@endforeach
@endsection

@section('tambah')
<a href="/pembelian/hutangs/laporan">
      <i id="filter" onmouseover="tulisan()" class="fas fa-file-alt mr-4" style="font-size:25px;color:#00BFA6;cursor: pointer;">
        <span></span>
      </i>
    </a>
@endsection