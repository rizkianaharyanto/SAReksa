@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Penyesuaian Stok')

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
@foreach ($stockAdjustments as $i => $stockAdjustment)
<tr>
    <td> {{$i+1}}</td>
    <td> {{ $stockAdjustment->kode_ref }}</td>
    <td> {{ $stockAdjustment->gudang->kode_gudang}}</td>
    <td> {{ $stockAdjustment->deskripsi }} </td>
    <td> {{ $stockAdjustment->departemen }} </td>
    <td> {{  $stockAdjustment->created_at->toDateString()}}</td>
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
                        href="{{ route('barang.destroy', $stockAdjustments->id ) }}">Delete</a>
                    <a class="dropdown-item " href="/stok/stock-opname/{{$stockAdjustments->id}}">Details</a>
                    <a class="dropdown-item " href="/stok/stock-opname/{{$stockAdjustments->id}}">Posting</a>

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
<input class="form-control" type="text" name="kode_ref" value="TRF-{{count($stockAdjustments)+1}}" id="field1">
<label for="gudang">Gudang </label>
<select onchange="populateBarangs()" class="form-control selectpicker" name="warehouse_id" id="gudang">
    @foreach($gudangs as $gudang)
    <option value="{{$gudang->id}}">{{$gudang->kode_gudang}}</option>
    @endforeach
</select>
<label for="field3">Deskripsi: </label>
<input class="form-control" type="text" name="deskripsi" id="field3">
{{-- <label for="field4">Departemen</label>
<input class="form-control" type="text" name="departemen" id="field3"> --}}
{{-- <label for="field4">akun_penyesuaian</label>
<input class="form-control" type="text" name="akun_penyesuaian" id="field3"> --}}
<p>{{$gudangs[0]->items}}</p>
<div id="formbarang" class="d-flex flex-column">
    <div id="isibarangs" class="d-flex">
        <div class="m-3">
            <label for="field4">Barang</label>
            <select class="selectpicker" name="item_id[]" id="field4">
                @foreach($barangs as $barang)
                <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                @endforeach
            </select>
        </div>
        <div class="m-3">
            <label for="field4">Selisih Stok</label>
            <input type="number" class="form-control" placeholder="( gunakan minus(-) jika stok berkurang"
                name="quantity_diff[]">
        </div>
    </div>

</div>
<div class="btn btn-primary btn-block" onclick="tambah()">Tambah Barang</div>

@endsection

@endsection


@section('scripts')
@parent

<script>
    function populateBarangs() {
        
    }
    function tambah(){
    $("#formbarang").append($("#isibarangs").clone());
}

</script>
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim().replace(' ','-');
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
@endsection