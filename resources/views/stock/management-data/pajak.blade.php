@extends('stock.management-data.layout')
@section('css')
@parent

@endsection
@section('title','Data Pajak Barang')


@section('table-header')

<tr>
    <th>No</th>
    <th>Jenis Pajak</th>
    <th>Deskripsi Pajak</th>
    <th>Nilai Pajak</th>
    <th>Dibuat Pada</th>
    <th>Terakhir Diubah</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach ($allData as $index => $pajak)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$pajak->jenis_pajak}}</td>
    <td>{{$pajak->deskripsi}}</td>

    <td>{{$pajak->tarif *100}} %</td>
    <td class=>{{date('d-m-Y',strtotime($pajak->created_at))}}</td>
    <td class=>{{date('d-m-Y',strtotime($pajak->updated_at))}}</td>

    <td id="options">
        <span id="edit-opt">
            <a href="" data-form="Edit Data" data-toggle="modal" data-target="#modalEdit{{$pajak->id}}"> Edit</a>
        </span> |
        <span id="delete-opt">
            <a class="delete-jquery" data-toggle="modal" style="cursor: pointer"
                data-target="#modalDelete{{$pajak->id}}">Delete</a>
        </span>
    </td>

    @php
    $action = '/stok/Management-Data/pajak/'.$pajak->id;

    @endphp

    <td>

        <x-stock.master-data.modal-edit :action="$action" :id="$pajak->id">

            <x-slot name="content">
                @method('PUT')
                <label for="namaSatuan">Jenis Pajak</label>
                <input class="form-control" required value="{{$pajak->jenis_pajak}}" type="text" name="jenis_pajak"
                    id="namaSatuan">
                <label for="namaSatuan">Deskripsi</label>
                <input class="form-control" required value="{{$pajak->deskripsi}}" type="text" name="deskripsi"
                    id="namaSatuan">
                <label for="nilai">Nilai Pajak</label>
                <input class="form-control" required value="{{$pajak->tarif *100}}" type="number" min="0" max="100"
                    name="tarif" id="nilai">

            </x-slot>
        </x-stock.master-data.modal-edit>
    </td>
</tr>
<x-stock.modal-stock-delete :deleteAction="$action" :id="$pajak->id">
    <x-slot name="header">
        {{$pajak->jenis_pajak}}
    </x-slot>

</x-stock.modal-stock-delete>
@endforeach
@endsection


@section('modal-form')
@parent
@section('modal-content')
@section('modal-form-action','/stok/Management-Data/pajak')
@section('modal-form-method','POST')
<label for="namaSatuan">Jenis Pajak</label>
<input class="form-control" required="" type="text" name="jenis_pajak" id="namaSatuan">
<label for="deskripsi">Deskripsi Pajak</label>
<input class="form-control" required placeholder="Pajak Pertambahan Nilai" type="text" name="deskripsi" id="deskripsi">

<label for="nilai">Nilai Pajak</label>
<input class="form-control" required type="number" min="0" max="100" name="tarif" id="nilai">
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