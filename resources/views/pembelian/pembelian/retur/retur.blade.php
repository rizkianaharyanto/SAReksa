@extends('pembelian.template.table')

@section('judul', 'Retur Pembelian')

@section('halaman', 'Retur Pembelian')

@section('thead')
<tr>
    <th>Kode Retur</th>
    <th>pemasok</th>
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
    <td>{{ $retur->pemasok->nama_pemasok }}</td>
    <td>{{ $retur->tanggal }}</td>
    <td>{{ $retur->total_harga }}</td>
    <td>{{ $retur->status !=null ? $retur->status  : '-' }} |
        @if ($retur->status_posting == 'sudah posting')
            sudah posting 
        @elseif ($retur->status_posting == 'konfirmasi')
        <a href="/pembelian/ubahpsnret/{{$retur->id}}">posting</a>
        @else
        <a href="/pembelian/postingret/{{$retur->id}}">posting</a>
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/returshow/{{$retur->id}}">
            <i style="cursor: pointer; " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <!-- <a id="edit" href="/pembelian/returs/{{$retur->id}}/edit">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a> -->
        <!-- <a id="delete" data-toggle="modal" data-target="#delete-{{$retur->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a> -->
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
        <x-pembelian.retur-delete :id="$retur->id" />
    </x-slot>
</x-modal>

@endforeach
@endsection


@section('tambah')
<a href="/pembelian/returs/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
<a href="/pembelian/returs/laporan">
      <i id="filter" onmouseover="tulisan()" class="fas fa-file-alt mr-4" style="font-size:25px;color:#00BFA6;cursor: pointer;">
        <span></span>
      </i>
    </a>
@endsection