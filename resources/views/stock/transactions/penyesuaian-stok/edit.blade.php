@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Penyesuaian Stok')

@section('main-content')
<form action="/stok/penyesuaian-stock/{{$penyesuaian->id}}" method="POST">

    @CSRF
    @method('PUT')
    <label for="field1">Kode Referensi </label>
    <input class="form-control" type="text" name="kode_ref" id="field1" value="{{$penyesuaian->kode_ref}}">
    @error('kode_ref')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="field2">Gudang </label>
    <select class="form-control selectpicker" name="warehouse_id" id="gudang_id">
        @foreach($gudangs as $gudang)
        <option value="{{$gudang->id}}" {{$gudang->id == "$penyesuaian->warehouse_id" ? "selected" : "" }}>
            {{$gudang->kode_gudang}}</option>
        @endforeach
    </select>
    @error('kode_ref')
    <div class="alert alert-danger">{{ $message }}</div>
    

    @enderror
    <label for="field3">Deskripsi: </label>
    <input class="form-control" type="text" name="deskripsi" id="field3" value="{{$penyesuaian->deskripsi}}">
    @error('deskripsi')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    
    <label for="field4">akun_penyesuaian</label>
    <input class="form-control" type="text" name="akun_penyesuaian" id="field3"
        value="{{$penyesuaian->akun_penyesuaian}}">
    @error('akun_penyesuaian')
    <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    @foreach($penyesuaian->details as $index => $barang)
    <div id="formbarang" class="d-flex flex-column">
        <div id="isibarangs" class="d-flex">
            <div class="m-3 select">
                <label for="field4">Barang</label>
                <select class="form-control isibarangs" name="item_id[]">
                    <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                </select>
                @error('item_id[]')
                <div class="alert alert-danger">{{ $message }}</div>

                @enderror
            </div>

            <div class="m-3 qty">
                <label for="field4">Selisih Stok</label>
                <input type="number" class="form-control" name="quantity_diff[]" value="{{$barang->pivot->quantity_diff}}">

                @error('quantity_diff[]')
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
    function tambah(){
         let barangInput = $("#isibarangs").clone()

          console.log(barangInput.children('select').html());
         $("#formbarang").append(barangInput);
         barangInput.append(' <a type="button" class="m-3 pt-4" onclick="hapus(this)"><i class="fas fa-window-close" style="color: red; cursor: pointer"></i></a>')
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
                console.log(data)
                console.log(data.length)
            $('.isibarangs').empty()
            for (i = 0; i < data.length; i++) {
                $(".isibarangs").append('<option value="' + data[i].barang.id + '">' + data[i].barang.nama_barang + '</option>')
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