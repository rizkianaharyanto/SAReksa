@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Opname')

@section('main-content')
<form style="p-3" action="/stok/transfer-stock/{{$transferStock->id}}" method="POST">

    @csrf
    @method('PUT')
    <label for="field1">Kode Referensi </label>
    <input class="form-control" readonly type="text" name="kode_ref" id="field1" value="{{$transferStock->kode_ref}}">
    @error('kode_ref')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <div class="row m-2">
        <div class="col">
            <label for="field2">Gudang Asal</label>
            <select required class="form-control selectpicker" name="gudang_asal" id="gudangAsal">
                @foreach($gudangs as $gudang)
                <option value="{{$gudang->id}}" {{$gudang->id == "$transferStock->gudang_asal" ? "selected" : "" }}>
                    {{$gudang->kode_gudang}}</option>
                @endforeach
            </select>
            @error('gudang_asal')
            <div class="alert alert-danger">{{ $message }}</div>

            @enderror
        </div>
        <div class="col">
            <label for="gudangTujuan">Gudang Tujuan</label>
            <select required class="form-control selectpicker" style="background-color: rgb(77, 134, 167)"
                name="gudang_tujuan" id="gudangTujuan">
                @foreach($gudangs as $gudang)
                <option value="{{$gudang->id}}" {{$gudang->id == "$transferStock->gudang_tujuan" ? "selected" : "" }}>
                    {{$gudang->kode_gudang}}</option>
                @endforeach
            </select>
            @error('gudang_tujuan')
            <div class="alert alert-danger">{{ $message }}</div>

            @enderror
        </div>
    </div>
    <label for="field3">Deskripsi: </label>
    <input class="form-control" type="text" name="deskripsi" id="field3" value="{{$transferStock->deskripsi}}">
    @error('deskripsi')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field4">Departemen</label>
    <input class="form-control" type="text" name="departemen" id="field3" value="{{$transferStock->departemen}}">
    @error('departemen')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field4">akun_penyesuaian</label>
    <input class="form-control" type="text" name="akun_penyesuaian" id="field3"
        value="{{$transferStock->akun_penyesuaian}}">
    @error('akun_penyesuaian')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    @foreach($transferStock->items as $index => $barang)
    <div id="formbarang" class="d-flex flex-column">
        <div id="isibarangs" class="d-flex">
            <div class="m-3">
                <label for="field4">Barang</label>
                <select class="form-control" name="barang_id[]" id="item_id">
                    <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                </select>
                @error('barang_id[]')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
            </div>

            <div class="m-3">
                <label for="field4">Jumlah Barang Berpindah </label>
                <input type="number" class="form-control" name="qty[]" value="{{$barang->pivot->kuantitas}}">

                @error('qty[]')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
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

$("#gudangAsal").change(function(){
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