@extends('stock.management-data.layout')
@section('css')
@parent

@endsection
@section('title','Data Satuan Unit')


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
    <td class=>{{date('d-m-Y',strtotime($u->created_at))}}</td>
    <td class=>{{date('d-m-Y',strtotime($u->updated_at))}}</td>

    <td id="options">
        <span id="edit-opt">
            <a href="" data-form="Edit Data" data-toggle="modal" data-target="#modalEdit{{$u->id}}"> Edit</a>
        </span> |
        <span id="delete-opt">
            <a class="delete-jquery" data-toggle="modal" style="cursor: pointer"
                data-target="#modalDelete{{$u->id}}">Delete</a>
        </span>
    </td>

    @php
    $action = '/stok/Management-Data/satuan-unit/'.$u->id;

    @endphp

    <td>

        <x-stock.master-data.modal-edit :action="$action" :id="$u->id">

            <x-slot name="content">
                @method('PUT')
                <label for="namaSatuan">Nama Satuan </label>
                <input class="form-control" required value="{{$u->nama_satuan}}" type="text" name="nama_satuan"
                    id="namaSatuan">

            </x-slot>
        </x-stock.master-data.modal-edit>
    </td>

    <x-stock.modal-stock-delete :deleteAction="$action" :id="$u->id">
        <x-slot name="header">
            {{$u->nama_satuan}}
        </x-slot>

    </x-stock.modal-stock-delete>
</tr>
@endforeach
@endsection


@section('modal-form')
@parent
@section('modal-content')
@section('modal-form-action','/stok/Management-Data/satuan-unit')
@section('modal-form-method','POST')
<label for="namaSatuan">Nama Satuan </label>
<input class="form-control" required="" type="text" name="nama_satuan" id="namaSatuan">

@endsection
@endsection

@section('scripts')
@parent
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim().replace(' ','-');
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#link-manajemen-data`).addClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
@endsection