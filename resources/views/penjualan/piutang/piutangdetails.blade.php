@extends('penjualan.template.table', [
    'elementActive' => 'piutang'
])

@section('judul', 'Detail Piutang')

@section('menu', 'Detail Piutang')

@section('thead')
<tr>
    <th>Kode Piutang</th>
    <th>Transaksi</th>
    <th>Total Piutang</th>
    <th style="column-width: 80px">Aksi</th>
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
    <td>{{ $piutang->total_piutang }}</td>
    <td class="d-flex justify-content-between">
        <i onclick="" style='color: #212120' class="fas fa-info-circle"></i>
    </td>
</tr>
@endforeach
@endsection