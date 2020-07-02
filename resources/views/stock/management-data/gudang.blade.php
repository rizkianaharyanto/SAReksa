@extends('stock.management-data.layout')
@section('css')
@parent

@endsection

@section('title','Data Gudang')



@section('table-header')

<tr>
    <th>No</th>
    <th>Kode Gudang</th>
    <th>Alamat</th>
    <th>No Telp</th>
    <th>Status</th>
    <th>Dibuat Pada</th>
    <th>Terakhir Diubah</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach ($allData as $index => $w)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$w->kode_gudang}}</td>
    <td>{{$w->alamat}}</td>
    <td>{{$w->no_telp}}</td>
    <td>{{$w->status}}</td>

    <td>{{\Carbon\Carbon::parse($w->created_at)->format('d-m-Y')}}</td>
    <td>{{\Carbon\Carbon::parse($w->created_at)->format('d-m-Y')}}</td>

    <td id="options">
        <span id="edit-opt">
            <a href="" data-form="Edit Data" data-toggle="modal" data-ctgid="{{$w->id}}" data-target=#modal> Edit</a>
        </span> |
        <span id="delete-opt">
            <a class="delete-jquery" data-toggle="modal" data-target="#modalDelete{{$w->id}}">Delete</a>
        </span>
    </td>
</tr>@php
$action = '/stok/Management-Data/gudang/'.$w->id;

@endphp
<x-stock.modal-stock-delete :deleteAction="$action" :id="$w->id">
    <x-slot name="header">
        {{$w->kode_gudang}}
    </x-slot>

</x-stock.modal-stock-delete>
@endforeach
@endsection

@section('modalId')
modalGudang
@endsection

@section('modal-form')
@parent
@section('modal-content')

@section('modal-form-action','/stok/Management-Data/gudang')
@section('modal-form-method','POST')
<label for="field1">Kode Gudang </label>
<input class="form-control" type="text" name="kode_gudang" id="field1" required>
<label for="field2">Alamat </label>
<textarea class="form-control" type="textarea" name="alamat" id="field2" rows="5" required></textarea>
<label for="field3">No Telpon: </label>
<input class="form-control" type="text" name="no_telp" required id="field3">
<label for="field4">Status</label>
<select class="form-control" name="status" id="field4" required>
    <option value="aktif">Aktif</option>
    <option value="tidak aktif">Tidak Aktif</option>
</select>
@endsection

@endsection

@section('scripts')
@parent
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim();
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#link-manajemen-data`).addClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
@endsection