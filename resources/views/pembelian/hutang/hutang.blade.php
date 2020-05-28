@extends('template.table')

@section('judul', 'Hutang')

@section('halaman', 'Hutang')

@section('thead')
<tr>
    <th>Kode Hutang</th>
    <th>Supplier</th>
    <th>Total Hutang</th>
    <th>Total Lunas</th>
    <th>Total Sisa</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($hutangs as $hutang)
<tr>
    <td>{{ $hutang->kode_hutang }}</td>
    <td>Supplier</td>
    <td>{{ $hutang->total_hutang }}</td>
    <td>{{ $hutang->total_lunas }}</td>
    <td>{{ $hutang->total_sisa }}</td>
    <td class="d-flex justify-content-between">
        <i onclick="" class="fas fa-info-circle"></i>
        <i onclick="" class="fas fa-edit"></i>
        <i onclick="" class="fas fa-trash"></i>
    </td>
</tr>
@endforeach
@endsection