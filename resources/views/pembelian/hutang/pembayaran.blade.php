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
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pembayarans as $pembayaran)
<tr>
    <td>{{ $pembayaran->kode_pembayaran }}</td>
    <td>{{ $pembayaran->pemasok->nama_pemasok }}</td>
    <td>{{ $pembayaran->tanggal }}</td>
    <td>{{ $pembayaran->total }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/pembayaranshow/{{$pembayaran->id}}">
            <button class="btn-info">

                <i style="cursor: pointer; " class="fas fa-info-circle">
                    <span></span>
                </i>
            </button>
        </a>
        <!-- <a id="edit" href="/pembelian/pembayarans/{{$pembayaran->id}}/edit">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$pembayaran->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a> -->
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