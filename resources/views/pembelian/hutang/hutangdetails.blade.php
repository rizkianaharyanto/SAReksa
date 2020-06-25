@extends('pembelian.template.table')

@section('judul', 'Hutang')

@section('halaman', 'Hutang')

@section('thead')
<tr>
    <th>Kode Hutang</th>
    <th>Transaksi</th>
    <!-- <th>Total Hutang</th> -->
    <th>Lunas</th>
    <th>Sisa</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($hutangs as $hutang)
<tr>
    <td>{{ $hutang->kode_hutang }}</td>
    <td>
        @if ($hutang->retur_id !=null){{$hutang->retur->kode_retur}}
        @elseif ($hutang->faktur_id !=null){{$hutang->faktur->kode_faktur}}
        @else -
        @endif
    </td>
    <!-- <td>{{ $hutang->total_hutang ? $hutang->total_hutang : '-' }}</td> -->
    <td>{{ $hutang->lunas ? $hutang->lunas : '-' }}</td>
    <td>{{ $hutang->sisa ? $hutang->sisa : '-' }}</td>
    <td>{{ $hutang->status ? $hutang->status : '-' }}</td>
    <td class="d-flex justify-content-between">
        <i onclick="" class="fas fa-info-circle"></i>
    </td>
</tr>
@endforeach
@endsection