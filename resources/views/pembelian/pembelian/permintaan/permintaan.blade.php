@extends('pembelian.template.table')

@section('judul', 'Permintaan Penawaran Harga')

@section('halaman', 'Permintaan Penawaran Harga')

@section('thead')
<tr>
    <th>Kode Permintaan</th>
    <th>pemasok</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($permintaans as $permintaan)
<tr>
    <td>{{ $permintaan->kode_permintaan }}</td>
    <td>{{ $permintaan->pemasok->nama_pemasok }}</td>
    <td>{{ $permintaan->tanggal }}</td>
    <td>{{ $permintaan->total_harga }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/permintaanshow/{{$permintaan->id}}">
            <i style="cursor: pointer; " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" href="/pembelian/permintaans/{{$permintaan->id}}/edit">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$permintaan->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a>
    </td>
</tr>

@php
$delete = "delete-".$permintaan->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus permintaan {{$permintaan->kode_permintaan}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-pembelian.permintaan-delete :id="$permintaan->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection

@section('tambah')
<a href="/pembelian/permintaans/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
<a href="/pembelian/permintaans/laporan">
      <i id="filter" onmouseover="tulisan()" class="fas fa-file-alt mr-4" style="font-size:25px;color:#00BFA6;cursor: pointer;">
        <span></span>
      </i>
    </a>
@endsection