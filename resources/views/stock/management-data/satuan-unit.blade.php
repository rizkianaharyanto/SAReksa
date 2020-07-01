@extends('stock.management-data.layout')
@section('css')
@parent

@endsection
@section('title')
Data Satuan Unit
@endsection


@section('table-header')

<tr>
    <th>No</th>
    <th>Nama Satuan</th>

    <th>Dibuat Pada</th>
    <th>Terakhir Diubah</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach ($allUnits as $index => $u)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$u->nama_satuan}}</td>
    <td>{{\Carbon\Carbon::parse($u->created_at)->format('d-m-Y')}}</td>
    <td>{{\Carbon\Carbon::parse($u->updated_at)->format('d-m-Y')}}</td>

    <td id="options">
        <span id="edit-opt">
            <a href="" data-form="Edit Data" data-toggle="modal" data-ctgid="{{$u->id}}" data-target=#modal> Edit</a>
        </span> |
        <span id="delete-opt">
            <a class="delete-jquery" data-toggle="modal" data-target="#modalDelete{{$u->id}}">Delete</a>
        </span>
    </td>
</tr>
@php
$action = '/stok/Management-Data/satuan-unit/'.$u->id;

@endphp
<x-stock.modal-stock-delete :deleteAction="$action" :id="$u->id">
    <x-slot name="header">
        {{$u->nama_satuan}}
    </x-slot>

</x-stock.modal-stock-delete>
@endforeach
@endsection


@section('modal-form')
@parent
@section('modal-content')
@section('modal-form-action','/stok/Management-Data/satuan-unit')
@section('modal-form-method','POST')
<label for="namaSatuan">Nama Satuan </label>
<input class="form-control" type="text" name="nama_satuan" id="namaSatuan">

@endsection
@endsection

@section('scripts')
@parent

@endsection