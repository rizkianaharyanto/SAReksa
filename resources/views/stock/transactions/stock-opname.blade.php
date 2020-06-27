@extends('stock.transactions.layout')

@section('css')
@parent
@endsection

@section('title')
Stock Opname
@endsection

@section('tableHeader')
<tr>
    <th>Tanggal</th>
    <th>Kode Referensi</th>
    <th>Gudang</th>
    <th>Deskripsi</th>
    <th>Departemen</th>
    <th>Opsi</th>
</tr>
@endsection


@section('tableBody')
@foreach ($stokOp as $op)
    <tr>
    <td>{{$op->created_at->toDateString()}}</td>
    <td>{{ $op->kode_ref }}</td>
    <td>{{ $op->gudang->kode_gudang}}</td>
    <td> {{ $op->deskripsi }} </td>
    <td> {{ $op->departemen }} </td>
    <td> 
        <span>
            <a href="" data-form="Edit Data" data-toggle="modal" data-target=#modal> Edit
            </a>
        </span> |
        <span>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <a class="delete-jquery" data-method="delete"
                href="{{ route('stock-opname.destroy', $op->id ) }}">Delete
            </a> 
        </span>
    </td>
</tr>
    @endforeach
@endsection

@section('modalId')
modalGudang
@endsection


@section('modalForm')
<label for="field1">Kode Referensi </label>
<input class="form-control" type="text" name="kode_ref" id="field1">
<label for="field2">Gudang </label>
<select class="form-control" name="gudang_id" id="field4">
    @foreach($gudangs as $gudang)
        <option value="{{$gudang->id}}">{{$gudang->kode_gudang}}</option>
    @endforeach
</select>
<label for="field3">Deskripsi:  </label>
<input class="form-control" type="text" name="deskripsi" id="field3">
<label for="field4">Departemen</label>
<input class="form-control" type="text" name="departemen" id="field3">
<label for="field4">akun_penyesuaian</label>
<input class="form-control" type="text" name="akun_penyesuaian" id="field3">
<div id="formbarang" class="d-flex flex-column">
    <div id="isibarangs" class="d-flex m-2">
        <div class="m-3">
            <label for="field4">Barang</label>
            <select class="form-control" name="item_id[]" id="field4">
                @foreach($barangs as $barang)
                <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                @endforeach
            </select>
        </div>
        <div class="m-3">
            <label for="field4">Jumlah Fisik</label>
            <input type="number" name="on_hand[]" >
        </div>
    </div>
</div>
<center><button type="button" onclick="tambah()">Tambah Barang</button></center>

@endsection

@section('scripts')
@parent

<script>
function tambah(){
    $("#formbarang").append($("#isibarangs").clone());
}

</script>

@endsection