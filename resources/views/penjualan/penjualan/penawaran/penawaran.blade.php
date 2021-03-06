@extends('penjualan.template.table', [
    'elementActive' => 'penawaran'
])
@section('judul', 'Penawaran')

@section('menu', 'Penawaran')

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
@foreach ($penawarans as $penawaran)
<tr>
    <td>{{ $penawaran->kode_penawaran }}</td>
    <td>{{ $penawaran->pelanggan->nama_pelanggan }}</td>
    <td>{{ $penawaran->tanggal }}</td>
    <td>{{ $penawaran->total_harga }}</td>
    <td>{{ $penawaran->status }}</td>
    <td class="d-flex justify-content-between">
        <a title="Details" id="details" href="/penjualan/penawarandetails/{{$penawaran->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if($penawaran->status == 'Belum dibuat pemesanan')
        <a title="Edit" id="edit" href="/penjualan/penawarans/{{$penawaran->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a title="Hapus" id="delete" data-toggle="modal" data-target="#delete-{{$penawaran->id }}">
            <i style="cursor: pointer; color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
    </td>
</tr>

@php
$delete = "delete-".$penawaran->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus penawaran {{$penawaran->kode_penawaran}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.penawaran-delete :id="$penawaran->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection

@section('tambah')
<a href="/penjualan/penawarans/create">
    <a href="/penjualan/penawarans/create" class="btn" style="background-color:#212120; color:white" >Tambah</a>
</a>
@endsection