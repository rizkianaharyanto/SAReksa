@extends('penjualan.template.table', [
    'elementActive' => 'retur'
])
@section('judul', 'Retur Penjualan')

@section('menu', 'Retur Penjualan')

@section('thead')
<tr>
    <th>Kode Retur</th>
    <th>Pelanggan</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($returs as $retur)
<tr>
    <td>{{ $retur->kode_retur }}</td>
    <td>{{ $retur->pelanggan->nama_pelanggan }}</td>
    <td>{{ $retur->tanggal }}</td>
    <td>{{ $retur->total_harga }}</td>
    <td>{{ $retur->status !=null ? $retur->status  : '-' }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/penjualan/returdetails/{{$retur->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" href="/penjualan/returs/{{$retur->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$retur->id }}">
            <i style="cursor: pointer;color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
    </td>
</tr>

@php
$delete = "delete-".$retur->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus retur {{$retur->kode_retur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.retur-delete :id="$retur->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection


@section('tambah')
<a href="/penjualan/returs/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#212120; cursor: pointer;">
        <span></span>
    </i>
</a>
@endsection