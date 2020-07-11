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
    <th>Diubah Pada</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach ($allData as $index => $k)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$k->kode_kategori}}</td>
    <td>{{$k->nama_kategori}}</td>
    <td class=>{{date('d-m-Y',strtotime($k->created_at))}}</td>
    <td class=>{{date('d-m-Y',strtotime($k->updated_at))}}</td>
    <td id="options">
        <span id="edit-opt">
            <a href="" data-form="Edit Data" data-toggle="modal" data-ctgid="{{$k->id}}"
                data-target="#modalEdit{{$k->id}}">
                Edit</a>
        </span>
        |
        <span id="delete-opt">
            <a class="" data-toggle="modal" style="cursor: pointer" data-target="#modalDelete{{$k->id}}">Delete</a>
        </span>
    </td>

    @php
    $action = '/stok/Management-Data/kategori-barang/'.$k->id;

    @endphp
    <td>

        <x-stock.master-data.modal-edit :action="$action" :id="$k->id">

            <x-slot name="content">
                @method('PUT')
                <label for="kodeKategori">Kode Kategori </label>
                <input class="form-control" value="{{$k->kode_kategori}}" type="text" id="field1" name="kode_kategori"
                    required>
                <label for="namaKategori">Nama Kategori </label>
                <input class="form-control" type="text" value="{{$k->nama_kategori}}" name="nama_kategori" id="field2"
                    required>

            </x-slot>
        </x-stock.master-data.modal-edit>
    </td>
</tr>
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
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim().replace(' ','-');
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#link-manajemen-data`).addClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>

@endsection