@extends('penjualan.template.table', [
    'elementActive' => 'faktur'
])
@section('judul', 'Faktur')

@section('menu', 'Faktur')

@section('thead')
<tr>
    <th>Kode Faktur</th>
    <th>Pelanggan</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th>Posting</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($fakturs as $faktur)
<tr>
    <td>{{ $faktur->kode_faktur }}</td>
    <td>{{ $faktur->pelanggan->nama_pelanggan }}</td>
    <td>{{ $faktur->tanggal }}</td>
    <td>{{ $faktur->total_harga }}</td>
    <td>{{ $faktur->status !=null ? $faktur->status  : '-' }}</td>
    <td>
        @if($faktur->status_posting == 'belum posting')Belum
        @else Sudah
        @endif
    </td>
    <td class="d-flex justify-content-between">
        <a title="Details" id="details" href="/penjualan/fakturdetails/{{$faktur->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if (auth()->user()->role == 'penjualan')
        @if($faktur->status_posting == 'belum posting')
        <a title="Edit" id="edit" href="/penjualan/fakturs/{{$faktur->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a title="Posting" id="posting"   data-toggle="modal" data-target="#posting-{{$faktur->id }}" title='Posting'>
        <i onmouseover="" style="cursor: pointer;color: #212120" class="fas fa-file-upload" title='Posting'>
                <span></span>
            </i>
        </a>
        @endif
        @if($faktur->status_posting == 'belum posting')
        <a id="delete" title="Delete" data-toggle="modal" data-target="#delete-{{$faktur->id }}">
            <i style="cursor: pointer;color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
        @endif
    </td>
</tr>

@php
$delete = "delete-".$faktur->id
@endphp
@php
$posting = "posting-".$faktur->id
@endphp
<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus Faktur {{$faktur->kode_faktur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.faktur-delete :id="$faktur->id" />
    </x-slot>
</x-modal>
<x-modal :id="$posting">
    <x-slot name="title">
        <h5 class="align-self-center">Posting Faktur {{$faktur->kode_faktur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.faktur-posting :id="$faktur->id" />
    </x-slot>
</x-modal>
@endforeach

@endsection

@section('tambah')
@if (auth()->user()->role == 'penjualan')
<a href="/penjualan/fakturs/create">
<a href="/penjualan/fakturs/create" class="btn" style="background-color:#212120; color:white" >Tambah</a>
</a>
@endif
@endsection