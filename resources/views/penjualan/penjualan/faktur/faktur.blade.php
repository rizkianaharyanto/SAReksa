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
        <a id="details" href="/penjualan/fakturdetails/{{$faktur->id}}">
            <i style="cursor: pointer;color:#212120 " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if($faktur->status_posting == 'belum posting')
        <a id="edit" href="/penjualan/fakturs/{{$faktur->id}}/edit">
            <i style="cursor: pointer;color:#212120" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="edit"  href="/penjualan/fakturs/{{$faktur->id}}/posting" title='Posting'>
        <i onmouseover="" style="cursor: pointer;color: #212120" class="fas fa-file-upload" title='Posting'>
                <span></span>
            </i>
        </a>
        @endif
        <a id="delete" data-toggle="modal" data-target="#delete-{{$faktur->id }}">
            <i style="cursor: pointer;color:#212120" class="fas fa-trash">
                <span></span>
            </i>
        </a>
    </td>
</tr>

@php
$delete = "delete-".$faktur->id
@endphp

<x-modal :id="$delete">
    <x-slot name="title">
        <h5 class="align-self-center">Hapus Faktur {{$faktur->kode_faktur}}</h5>
    </x-slot>
    <x-slot name="body">
        <x-penjualan.faktur-delete :id="$faktur->id" />
    </x-slot>
</x-modal>
@endforeach

@endsection

@section('tambah')
<a href="/penjualan/fakturs/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#212120; cursor: pointer;">
        <span></span>
    </i>
</a>
@endsection