@extends('pembelian.template.table')

@section('judul', 'Hutang Details')

@section('halaman', 'Hutang')

@section('path')
<li><a href="#">Hutang</a></li>
<li><a href="/pembelian/hutangs">Hutang</a></li>
<li class="active">Hutang Details</li>
@endsection

@section('thead')
<tr>
    <th>Tanggal</th>
    <th>Kode Hutang</th>
    <th>Transaksi</th>
    <th>Lunas</th>
    <th>Sisa</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($hutangs as $hutang)
<tr>
    <td>{{ $hutang->tanggal ? $hutang->tanggal : '-' }}</td>
    <td>{{ $hutang->kode_hutang }}</td>
    <td>
        @if ($hutang->retur_id !=null){{$hutang->retur->kode_retur}}
        @elseif ($hutang->faktur_id !=null){{$hutang->faktur->kode_faktur}}
        @else -
        @endif
    </td>
    <td>@currency($hutang->lunas)</td>
    <td>@currency($hutang->sisa)</td>
    <td>{{ $hutang->status ? $hutang->status : '-' }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/hutangshow/{{$hutang->id}}">
            <button class="btn-info">

                <i style="cursor: pointer; " class="fas fa-info-circle">
                    <span></span>
                </i>
            </button>
        </a>
    </td>
</tr>
@endforeach
@endsection