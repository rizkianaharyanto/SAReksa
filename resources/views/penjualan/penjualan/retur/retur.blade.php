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
    <th>Posting</th>
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
    <td>
        @if($retur->status_posting == 'belum posting')Belum
        @else Sudah
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a title="Details"id="details" href="/penjualan/returdetails/{{$retur->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if (auth()->user()->role == 'retur')
        @if($retur->status_posting == 'belum posting')
        <a title="Edit"id="edit" href="/penjualan/returs/{{$retur->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a title="Posting" id="posting"   title='Posting' data-toggle="modal" data-target="#posting-{{$retur->id }}">
        <i onmouseover="" style="cursor: pointer;color: #212120" class="fas fa-file-upload" title='Posting'>
                <span></span>
            </i>
        </a>
        @endif
        @if($retur->status_posting == 'belum posting')
        <a title="Delete"id="delete" data-toggle="modal" data-target="#delete-{{$retur->id }}">
            <i style="cursor: pointer;color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
        @endif
    </td>
</tr>

@php
$delete = "delete-".$retur->id
@endphp
@php
$posting = "posting-".$retur->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus retur {{$retur->kode_retur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.retur-delete :id="$retur->id" />
    </x-slot>
</x-modal>

<x-modal :id="$posting">
    <x-slot name="title">
        <h5 class="align-self-center">Posting retur {{$retur->kode_retur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.retur-posting :id="$retur->id" />
    </x-slot>
</x-modal>
@endforeach
@endsection


@section('tambah')
@if (auth()->user()->role == 'retur')
<a href="/penjualan/returs/create">
<a href="/penjualan/returs/create" class="btn" style="background-color:#212120; color:white" >Tambah</a>
</a>
@endif
@endsection