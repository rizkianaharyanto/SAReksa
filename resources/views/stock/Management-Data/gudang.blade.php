@extends('stock.Management-Data.layout')
@section('css')
@parent

@endsection
@section('title')
Data Gudang
@endsection
   

    @section('tableHeader')

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


    @section('tableBody')


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
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <a class="delete-jquery" data-method="delete"
                        href="{{ route('gudang.destroy', $w->id ) }}">Delete</a> 
                </span>
            </td>
        </tr>
        @endforeach
    @endsection

@section('modalId')
modalGudang
@endsection

@section('modalForm')
<label for="field1">Kode Gudang </label>
<input class="form-control" type="text" name="kode_gudang" id="field1">
<label for="field2">Alamat </label>
<textarea class="form-control" type="textarea" name="alamat" id="field2" rows="5"></textarea>
<label for="field3">No Telpon:  </label>
<input class="form-control" type="text" name="no_telp" id="field3">
<label for="field4">Status</label>
<select class="form-control" name="status" id="field4">
    <option value="aktif">Aktif</option>
    <option value="tidak aktif">Tidak Aktif</option>
</select>

@endsection

@section('scripts')
@parent

@endsection