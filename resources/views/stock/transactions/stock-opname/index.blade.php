@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Opname')

@section('table-header')
<tr>
    <th>#</th>
    <th>Kode Referensi</th>
    <th>Gudang</th>
    <th>Deskripsi</th>
    <th>Departemen</th>
    <th>Tanggal</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')
@foreach ($stokOp as $i=> $op)
<tr>
    <td>{{$i+1}}</td>
    <td>{{ $op->kode_ref }}</td>
    <td>{{ $op->gudang->kode_gudang}}</td>
    <td> {{ $op->deskripsi }} </td>
    <td> {{ $op->departemen }} </td>
    <td>{{$op->created_at->toDateString()}}</td>
    <td>
        <center>
            <div class="dropright">

                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item" href="" data-form="Edit Data"> Edit</a>
                    <a class="delete-jquery dropdown-item" data-method="delete"
                        href="{{ route('barang.destroy', $op->id ) }}">Delete</a>
                    <a class="dropdown-item " href="/stok/stock-opname/{{$op->id}}">Details</a>
                    <a class="dropdown-item " href="/stok/stock-opname/{{$op->id}}">Posting</a>

                </div>
            </div>
        </center>
    </td>
</tr>
@endforeach
@endsection
@if ($errors->any())

@endif
@section('modal-form')
@parent
@section('modal-content')

@section('modal-form-action','/stok/stock-opname')
@section('modal-form-method','POST')

<label for="field1">Kode Referensi </label>
<input class="form-control" type="text" name="kode_ref" id="field1">
<label for="field2">Gudang </label>
<select class="form-control" name="gudang_id" id="field4">
    @foreach($gudangs as $gudang)
    <option value="{{$gudang->id}}">{{$gudang->kode_gudang}}</option>
    @endforeach
</select>
<label for="field3">Deskripsi: </label>
<input class="form-control" type="text" name="deskripsi" id="field3">
<label for="field4">Departemen</label>
<input class="form-control" type="text" name="departemen" id="field3">
<label for="field4">akun_penyesuaian</label>
<input class="form-control" type="text" name="akun_penyesuaian" id="field3">
<div id="formbarang" class="d-flex flex-column">
    <div id="isibarangs" class="d-flex m-2">
        <div class="m-3">
            <label for="field4">Barang</label>
            <select class="selectpicker" name="item_id[]" id="field4">
                @foreach($barangs as $barang)
                <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                @endforeach
            </select>
        </div>
        <div class="m-3">
            <label for="field4">Hasil Stok Opname</label>
            <input type="number" class="form-control" name="on_hand[]">
        </div>
    </div>
</div>
@endsection

@endsection


@section('scripts')
@parent

<script>
    function tambah(){
    $("#formbarang").append($("#isibarangs").clone());
}

</script>

@endsection