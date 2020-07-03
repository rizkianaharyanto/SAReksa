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
                    <a class="dropdown-item" href="/stok/stock-opname/{{$op->id}}/edit" data-form="Edit Data"> Edit</a>
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
<select class="form-control selectpicker" name="gudang_id" id="gudang_id">
    <option value="">--- Pilih Gudang ---</option>
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
    <div id="isibarangs" class="d-flex">
        <div class="m-3">
            <label for="field4">Barang</label>
            <select class="form-control" name="item_id[]" id="item_id">
                <option value="">--- Pilih Barang ---</option>
            </select>
        </div>
        <div class="m-3">
            <label for="field4">Hasil Stok Opname</label>
            <input type="number" class="form-control" name="on_hand[]">
        </div>
    </div>

</div>
<div class="btn btn-primary btn-block" onclick="tambah()">Tambah Barang</div>

@endsection

@endsection


@section('scripts')
@parent

<script>
    function tambah(){
    $("#formbarang").append($("#isibarangs").clone());
}

$("#gudang_id").change(function(){
    $.ajax({
        url: '/stok/getstocksbywarehouse/' + $(this).val(),
        type: 'get',
        retur: {},
        success: function(data) {
                console.log(data)
                console.log(data.length)
            $('#item_id').empty()
            $("#item_id").append('<option value="">--- Pilih Barang ---</option>')
            for (i = 0; i < data.length; i++) {
                $("#item_id").append('<option value="' + data[i].barang.id + '">' + data[i].barang.nama_barang + '</option>')
            }
        }
    })
})

</script>
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim().replace(' ','-');
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
@endsection