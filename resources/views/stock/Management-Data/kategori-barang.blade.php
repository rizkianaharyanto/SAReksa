@extends('stock.Management-Data.layout')
@section('css')
@parent

@endsection
@section('title')
Data Kategori Barang
@endsection
   

    @section('tableHeader')

    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Kategori</th>
        <th>Dibuat Pada</th>
        <th>Opsi</th>
    </tr>
    @endsection


    @section('tableBody')


        @foreach ($allData as $index => $k)

        <tr>
            <td>{{$index+1}}</td>
            <td>{{$k->kode_kategori}}</td>
            <td>{{$k->nama_kategori}}</td>
            <td>{{\Carbon\Carbon::parse($k->created_at)->format('d-m-Y')}}</td>
            <td id="options"> 
                <span id="edit-opt">
                    <a href="" data-form="Edit Data" data-toggle="modal" data-ctgid="{{$k->id}}" data-target=#modal> Edit</a>
                </span> 
                |
                <span id="delete-opt">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <a class="delete-jquery" data-method="delete"
                    href="{{ route('kategori-barang.destroy', $k->id ) }}">Delete</a> 
                </span>
            </td>
        </tr>
        @endforeach
    @endsection

@section('modalId')
!!modalKategoriBarang!!
@endsection

@section('modalForm')
<label for="kodeKategori">Kode Kategori </label>
<input class="form-control" type="text" id="field1" name="kode_kategori">
<label for="namaKategori">Nama Kategori </label>
<input class="form-control" type="text" name="nama_kategori" id="field2">
@endsection

@section('scripts')
@parent

@endsection