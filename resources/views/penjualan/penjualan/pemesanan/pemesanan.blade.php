@extends('penjualan.template.table', [
    'elementActive' => 'pemesanan'
])
@section('judul', 'Pemesanan')

@section('menu', 'Pemesanan')

@section('thead')

<tr>
    <th>Kode Penawaran</th>
    <th>Pelanggan</th>
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
    <td>{{ $pemesanan->pelanggan->nama_pelanggan }}</td>
    <td>{{ $pemesanan->tanggal }}</td>
    <td>{{ $pemesanan->total_harga }}</td>
    <td>{{ $pemesanan->status !=null ? $pemesanan->status  : '-' }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/penjualan/pemesanandetails/{{$pemesanan->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" href="/penjualan/pemesanans/{{$pemesanan->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$pemesanan->id }}">
            <i style="cursor: pointer; color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
    </td>
</tr>

@php
$delete = "delete-".$pemesanan->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus pemesanan {{$pemesanan->kode_pemesanan}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.pemesanan-delete :id="$pemesanan->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection

@section('tambah')
<a href="/penjualan/pemesanans/create">
<a href="/penjualan/pemesanans/create" class="btn" style="background-color:#212120; color:white" >Tambah</a>

</a>
@endsection

