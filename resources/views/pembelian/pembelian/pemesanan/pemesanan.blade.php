@extends('pembelian.template.table')

@section('judul', 'pemesanan')

@section('halaman', 'Pemesanan')

@section('thead')
<tr>
    <th>Kode Pemesanan</th>
    <th>pemasok</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pemesanans as $pemesanan)
<tr>
    <td>{{ $pemesanan->kode_pemesanan }}</td>
    <td>{{ $pemesanan->pemasok->nama_pemasok }}</td>
    <td>{{ $pemesanan->tanggal }}</td>
    <td>{{ $pemesanan->total_harga }}</td>
    <td>{{ $pemesanan->status !=null ? $pemesanan->status  : '-' }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/pemesananshow/{{$pemesanan->id}}">
            <i style="cursor: pointer; " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if ($pemesanan->status != 'selesai' && $pemesanan->status != 'diterima')
        <a id="edit" href="/pembelian/pemesanans/{{$pemesanan->id}}/edit">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$pemesanan->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
    </td>
</tr>

@php
$delete = "delete-".$pemesanan->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus pesanan {{$pemesanan->kode_pemesanan}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-pembelian.pemesanan-delete :id="$pemesanan->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection

@section('tambah')
<a href="/pembelian/pemesanans/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
@endsection