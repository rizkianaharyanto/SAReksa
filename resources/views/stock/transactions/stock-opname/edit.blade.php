@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Opname')

@section('main-content')
<form action="/stok/stock-opname/{{$stockOpname->id}}" method="POST">

    @csrf
    @method('PUT')
    <label for="field1">Kode Referensi </label>
    <input class="form-control" type="text" name="kode_ref" id="field1" value="{{$stockOpname->kode_ref}}">
    @error('kode_ref')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field2">Gudang </label>
    <select class="form-control selectpicker" name="gudang_id" id="gudang_id">
        @foreach($gudangs as $gudang)
        <option value="{{$gudang->id}}" {{$gudang->id == "$stockOpname->gudang_id" ? "selected" : "" }}>
            {{$gudang->kode_gudang}}</option>
        @endforeach
    </select>
    @error('kode_ref')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field3">Deskripsi: </label>
    <input class="form-control" type="text" name="deskripsi" id="field3" value="{{$stockOpname->deskripsi}}">
    @error('deskripsi')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field4">Departemen</label>
    <input class="form-control" type="text" name="departemen" id="field3" value="{{$stockOpname->departemen}}">
    @error('departemen')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field4">akun_penyesuaian</label>
    <input class="form-control" type="text" name="akun_penyesuaian" id="field3"
        value="{{$stockOpname->akun_penyesuaian}}">
    @error('akun_penyesuaian')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    @foreach($stockOpname->details as $index => $barang)
    <div id="formbarang" class="d-flex flex-column">
        <div class="d-flex inputbarangs">
            <div class="m-3 select">
                <label for="field4">Barang</label>
                <select class="form-control isibarangs" name="item_id[]">
                    <option value="{{$barang->id}}">{{$barang->nama_barang}} </option>
                </select>
                @error('item_id[]')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
            </div>

            <div class="m-3 qty">
                <label for="field4">Hasil Stok Opname</label>
                <input type="number" class="form-control" name="on_hand[]" min="0"
                    value="{{$barang->pivot->jumlah_fisik}}">

                @error('on_hand[]')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
            </div>
        </div>
    </div>
    @endforeach
    <div class="btn btn-primary" onclick="tambah()">Tambah Barang</div>
    <button class="btn btn-primary btn-block m-3" type="submit">Ubah</button>
</form>
@endsection

@section('scripts')
@parent

<script>
    let i = 0 
    function tambah() {
        let selected = $('.inputbarangs').last().find('option:selected').val();
        let barangInput = $(".inputbarangs").last().clone()
        barangInput.find('option').each(function (index,data){
            if($(this).val() == selected)
            {
                $(this).remove();
            }
        })
        if ($(".inputbarangs").last().is(':first-child')) {
            $("#formbarang").append(barangInput);
            
            $("#formbarang").find('.inputbarangs').last().append(' <a type="button" class="m-3 pt-4" onclick="hapus(this)"><i class="fas fa-window-close" style="color: red; cursor: pointer"></i></a>');
        }
        else{
            $("#formbarang").append(barangInput);
            
        }
    }

    function hapus(x){
        $(x).parent().remove()
    }

$("#gudang_id").change(function(){
    $.ajax({
        url: '/stok/getstocksbywarehouse/' + $(this).val(),
        type: 'get',
        retur: {},
        success: function(data) {
            $('.isibarangs').empty()
            for (i = 0; i < data.length; i++) {
                $(".isibarangs").append(`<option value="${data[i].barang.id}" data-kuantitas=${data[i].kuantitas} >` + data[i].barang.nama_barang + `       \t(${data[i].kuantitas})`+'</option>')
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