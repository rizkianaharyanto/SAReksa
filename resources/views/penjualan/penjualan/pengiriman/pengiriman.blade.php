@extends('penjualan.template.table', [
    'elementActive' => 'pengiriman'
])
@section('judul', 'Pengiriman')

@section('menu', 'Pengiriman')

@section('thead')
<tr>
    <th>Kode Pengiriman</th>
    <th>pelanggan</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pengirimans as $pengiriman)
<tr>
    <td>{{ $pengiriman->kode_pengiriman }}</td>
    <td>{{ $pengiriman->pelanggan->nama_pelanggan }}</td>
    <td>{{ $pengiriman->tanggal }}</td>
    <td>{{ $pengiriman->total_harga }}</td>
    <td>{{ $pengiriman->status !=null ? $pengiriman->status  : '-' }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/penjualan/pengirimandetails/{{$pengiriman->id}}">
            <i style="cursor: pointer;color: #212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if($pengiriman->status == 'dalam pengiriman')
        <a id="edit"  href="/penjualan/pengirimans/{{$pengiriman->id}}/edit" title='Konfirmasi'>
            <i style="cursor: pointer;color: #212120" class="fas fa-check">
                <span></span>
            </i>
        </a>
        @endif
        @if($pengiriman->status == 'terkirim')
        <a id="edit" href="/penjualan/pengirimans/{{$pengiriman->id}}/posting">
            <i onmouseover="" style="cursor: pointer;color: #212120" class="fas fa-file-upload" title='Posting'>
                <span></span>
            </i>
        </a>
        @endif
        <a id="delete" data-toggle="modal" data-target="#delete-{{$pengiriman->id }}">
            <i style="cursor: pointer;color: #212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
    </td>
</tr>

@php
$delete = "delete-".$pengiriman->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus pengiriman {{$pengiriman->kode_pengiriman}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.pengiriman-delete :id="$pengiriman->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection


@section('tambah')
<a href="/penjualan/pengirimans/create">
<a href="/penjualan/pengirimans/create" class="btn" style="background-color:#212120; color:white" >Tambah</a>

</a>
@endsection