@extends('template.table')

@section('judul', 'Faktur')

@section('halaman', 'Faktur')

@section('thead')
<tr>
    <th>Kode Faktur</th>
    <th>Supplier</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($fakturs as $faktur)
<tr>
    <td>{{ $faktur->kode_faktur }}</td>
    <td>Supplier</td>
    <td>{{ $faktur->tanggal }}</td>
    <td>{{ $faktur->total_harga }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/fakturs/create">
            <i style="cursor: pointer; " class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" href="/fakturs/{{$faktur->id}}/edit">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#delete-{{$faktur->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
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
        <x-faktur-delete :id="$faktur->id" />
    </x-slot>
</x-modal>


@endforeach

@endsection

@section('tambah')
<a href="/fakturs/create">
    <i class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
@endsection