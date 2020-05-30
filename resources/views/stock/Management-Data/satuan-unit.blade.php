@extends('stock.Management-Data.layout')
@section('css')
@parent

@endsection
@section('title')
Data Satuan Unit
@endsection
   

    @section('tableHeader')

    <tr>
        <th>No</th>
        <th>Nama Satuan</th>
        
        <th>Dibuat Pada</th>
        <th>Terakhir Diubah</th>
        <th>Opsi</th>
    </tr>
    @endsection


    @section('tableBody')


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
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <a class="delete-jquery" data-method="delete"
                        href="{{ route('satuan-unit.destroy', $u->id ) }}">Delete</a> 
                </span>
            </td>
        </tr>
   
        @endforeach
    @endsection

@section('modalId')
!!modalKategoriBarang!!
@endsection

@section('modalForm')
<label for="namaSatuan">Nama Satuan </label>
<input class="form-control" type="text" name="nama_satuan" id="field1">
@endsection

@section('scripts')
@parent

@endsection