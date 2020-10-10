@extends('pembelian.template.table')

@section('judul', 'Hutang')

@section('halaman', 'Hutang')

@section('path')
<li><a href="/pembelian/hutang-bagi">Hutang</a></li>
<li class="active">Hutang Faktur</li>
@endsection

@section('thead')
<tr>
    <th>Tanggal</th>
    <th>Kode Hutang</th>
    <th>Pemasok</th>
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
    <td>{{ $hutang->pemasok->nama_pemasok }}</td>
    <td>
        @if ($hutang->retur_id !=null){{$hutang->retur->kode_retur}}
        @elseif ($hutang->faktur_id !=null){{$hutang->faktur->kode_faktur}}
        @else -
        @endif
    </td>
    <td>@currency( $hutang->lunas )</td>
    <td>@currency( $hutang->sisa)</td>
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

@section('tambah')
<a data-toggle="modal" data-target="#modaltambah">
    <button class="btn-sm btn-info">Filter</button>
</a>
@endsection

@section('judulTambah')
<h5 class="align-self-center">Filter Hutang</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/pembelian/hutangs-filter">
    @csrf
    <div class="form-group">
       
         Dari <input class="form-control m-2" type="date" name="start">
         Sampai <input class="form-control m-2" type="date" name="end">
    </div>

    @endsection