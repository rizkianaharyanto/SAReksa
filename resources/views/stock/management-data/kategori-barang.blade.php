@extends('stock.management-data.layout')
@section('css')
@parent

@endsection
@section('title','Data Kategori Barang')



@section('table-header')

<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Kategori</th>
    <th>Dibuat Pada</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach ($allData as $index => $k)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$k->kode_kategori}}</td>
    <td>{{$k->nama_kategori}}</td>
    <td>{{\Carbon\Carbon::parse($k->created_at)->format('d-m-Y-H-i-s')}}</td>
    <td id="options">
        <span id="edit-opt">
            <a href="" data-form="Edit Data" data-toggle="modal" data-ctgid="{{$k->id}}" data-target=#modal> Edit</a>
        </span>
        |
        <span id="delete-opt">
            <a class="delete-jquery" data-toggle="modal" data-target="#modalDelete{{$k->id}}">Delete</a>
        </span>
    </td>
</tr>
@php
$action = '/stok/Management-Data/kategori-barang/'.$k->id;

@endphp
<x-stock.modal-stock-delete :deleteAction="$action" :id="$k->id">
    <x-slot name="header">
        {{$k->nama_kategori}}
    </x-slot>

</x-stock.modal-stock-delete>
@endforeach
@endsection

@section('modal-form')
@parent
@section('modal-content')
@section('modal-form-action','/stok/Management-Data/kategori-barang')
@section('modal-form-method','POST')
<label for="kodeKategori">Kode Kategori </label>
<input class="form-control" type="text" id="field1" name="kode_kategori" required>
<label for="namaKategori">Nama Kategori </label>
<input class="form-control" type="text" name="nama_kategori" id="field2" required>
@endsection
@endsection


@section('scripts')
@parent

@endsection