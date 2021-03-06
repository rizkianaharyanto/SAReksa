@extends('pembelian.template.table')

@section('judul', 'Pembayaran Hutang')

@section('halaman', 'Pembayaran Hutang')

@section('path')
<li><a href="#">Hutang</a></li>
<li class="active">Pembayaran Hutang</li>
@endsection

@section('thead')
<tr>
    <th>Kode Pembayaran</th>
    <th>Supplier</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pembayarans as $pembayaran)
<tr>
    <td>{{ $pembayaran->kode_pembayaran }}</td>
    <td>{{ $pembayaran->pemasok->nama_pemasok }}</td>
    <td>{{ $pembayaran->tanggal }}</td>
    <td>@currency($pembayaran->total)</td>
    <td>@if ($pembayaran->status)
        {{ $pembayaran->status }}
        @else
        <a href="/pembelian/postingpem/{{$pembayaran->id}}">posting</a>
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/pembayaranshow/{{$pembayaran->id}}">
            <button class="btn-info">
                <i style="cursor: pointer; " class="fas fa-info-circle">
                    <span></span>
                </i>
            </button>
        </a>
        @if($pembayaran->status == null)
        <a id="edit" href="/pembelian/pembayarans/{{$pembayaran->id}}/edit">
            <button class="btn-warning">
                <i style="cursor: pointer;" class="fas fa-edit">
                    <span></span>
                </i>
            </button>
        </a>
        <form method="POST" action="/pembelian/pembayarans/{{$pembayaran->id}}">
            @method('delete')
            @csrf
            <button type="submit" class="btn-danger"><i style="cursor: pointer;" class="fas fa-trash">
                    <span></span>
                </i></button>
        </form>
        @endif
    </td>
</tr>

@php
$delete = "delete-".$pembayaran->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus Pembayaran {{$pembayaran->kode_pembayaran}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-pembelian.pembayaran-delete :id="$pembayaran->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection

@section('tambah')
<a href="/pembelian/pembayarans/create">
    <button class="btn-sm btn-outline-info">Tambah</button>
</a>

@endsection