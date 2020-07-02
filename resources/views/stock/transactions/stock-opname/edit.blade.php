@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Opname')

@section('table-header')
<form action="">
    @csrf
<label for="field1">Kode Referensi </label>
<input class="form-control" type="text" name="kode_ref" id="field1" value="{{$stockOpname[0]->kode_ref}}">
<label for="field2">Gudang </label>
<select class="form-control selectpicker" name="gudang_id" id="gudang_id">
    @foreach($gudangs as $gudang)
    <option value="{{$gudang->id}}" {{$gudang->id == "$stockOpname[0]->gudang_id" ? "selected" : "" }}>{{$gudang->kode_gudang}}</option>
    @endforeach
</select>
<label for="field3">Deskripsi: </label>
<input class="form-control" type="text" name="deskripsi" id="field3" value="{{$stockOpname[0]->deskripsi}}">
<label for="field4">Departemen</label>
<input class="form-control" type="text" name="departemen" id="field3" value="{{$stockOpname[0]->departemen}}">
<label for="field4">akun_penyesuaian</label>
<input class="form-control" type="text" name="akun_penyesuaian" id="field3" value="{{$stockOpname[0]->akun_penyesuaian}}">
@foreach($stockOpname[0]->details as $index => $barang)
<div id="formbarang" class="d-flex flex-column">
    <div id="isibarangs" class="d-flex">
        <div class="m-3">
            <label for="field4">Barang</label>
            <select class="form-control" name="item_id[]" id="item_id">
                <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
            </select>
        </div>
        <div class="m-3">
            <label for="field4">Hasil Stok Opname</label>
            <input type="number" class="form-control" name="on_hand[]" value="{{$barang->pivot->jumlah_fisik}}">
        </div>
    </div>
</div>
@endforeach
<div class="btn btn-primary btn-block" onclick="tambah()">Tambah Barang</div>
<button class="btn btn-primary btn-block" type="submit">Ubah</button>
</form>
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

