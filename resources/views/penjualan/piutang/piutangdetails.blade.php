@extends('penjualan.template.table', [
    'elementActive' => 'piutang'
])

@section('judul', 'Detail Piutang')

@section('menu', 'Detail Piutang')

@section('thead')
<tr>
    <th>Kode Piutang</th>
    <th>Transaksi</th>
    <th>Lunas</th>
    <th>Sisa</th>
    <th>Status</th>
</tr>
@endsection

@section('tbody')
@foreach ($piutangs as $piutang)
<tr>
    <td>{{ $piutang->kode_piutang }}</td>
    <td>
        @if ($piutang->retur_id !=null){{$piutang->retur->kode_retur}}
        @elseif ($piutang->faktur_id !=null){{$piutang->faktur->kode_faktur}}
        @else -
        @endif
    </td>
    <td>{{ $piutang->lunas ? $piutang->lunas : '-' }}</td>
    <td>{{ $piutang->sisa ? $piutang->sisa : '-' }}</td>
    <td>{{ $piutang->status ? $piutang->status : '-' }}</td>
    
</tr>
@endforeach
@endsection