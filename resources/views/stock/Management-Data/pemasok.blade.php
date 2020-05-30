@extends('stock.Management-Data.layout')
@section('css')
@parent

@endsection
@section('title')
Data Pemasok
@endsection
   

    @section('tableHeader')

    <tr>
        <th>No</th>
        <th>Kode Pemasok</th>
        <th>Nama Pemasok</th>
        <th>Alamat</th>
        <th>Nomor Telepon</th>
        <th>Terakhir Diubah</th>
        <th>Opsi</th>
    </tr>
    @endsection


    @section('tableBody')


        @foreach ($allData as $index => $s)

        <tr>
            <td>{{$index+1}}</td>
            <td>{{$s->kode_supplier}}</td>
            <td>{{$s->nama_supplier}}</td>
            <td>{{$s->alamat}}</td>
            <td>{{$s->no_telp}}</td>
            <td>{{\Carbon\Carbon::parse($s->updated_at)->format('d-m-Y')}}</td>


            <td id="options"> 
                <span id="edit-opt">
                    <a href="" data-form="Edit Data" data-toggle="modal" data-ctgid="{{$s->id}}" data-target=#modal> Edit</a>
                </span> |
                <span id="delete-opt">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <a class="delete-jquery" data-method="delete"
                        href="{{ route('gudang.destroy', $s->id ) }}">Delete</a>
                </span>
            </td>
        </tr>
        @endforeach
    @endsection

@section('modalId')
modalGudang
@endsection

@section('modalForm')
<label for="kodePemasok">Kode Pemasok </label>
<input class="form-control" type="text" name="kode_supplier" id="field1">
<label for="namaPemasok">Nama Pemasok </label>
<input class="form-control" type="text" name="nama_supplier" id="field2">
<label for="Alamat">Alamat </label>
<textarea class="form-control" type="textarea" name="alamat" id="field3" rows="5"></textarea>
<label for="noTelp">No Telpon:  </label>
<input class="form-control" type="text" name="no_telp" id="field4">

@endsection

@section('scripts')
@parent

@endsection