@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Transfer Stock')

@section('table-header')
<tr>
    <th>Tanggal</th>
    <th>Kode Referensi</th>
    <th>Gudang Asal</th>
    <th>Gudang Tujuan</th>
    <th>Deskripsi</th>
    <th>Departemen</th>
    <th>Jumlah Barang</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')
@foreach ($allData as $transfer)
<tr>
    <td>{{$transfer->created_at->toDateString()}}</td>
    <td>{{ $transfer->kode_ref }}</td>
    <td>{{ $transfer->asal->kode_gudang}}</td>
    <td>{{ $transfer->tujuan->kode_gudang}}</td>
    <td> {{ $transfer->deskripsi }} </td>
    <td> {{ $transfer->departemen }} </td>
    <td>{{count($transfer->items)}}</td>
    <td>
        <center>
            <div class="btn-group dropleft">

                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item" href="" data-form="Edit Data"> Edit</a>
                    <a class="delete-jquery dropdown-item" data-method="delete"
                        href="{{ route('barang.destroy', $transfer->id ) }}">Delete</a>
                    <a class="dropdown-item " href="/stok/transfer-stock/{{$transfer->id}}">Details</a>
                    <a class="dropdown-item " href="/stok/transfer-stock/{{$transfer->id}}">Posting</a>

                </div>
            </div>
        </center>
    </td>
</tr>
@endforeach
@endsection
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@section('modal-form')
@parent
@section('modal-content')

@section('modal-form-action','/stok/transfer-stock')
@section('modal-form-method','POST')

<label for="field1">Kode Referensi </label>
<input class="form-control" type="text" name="kode_ref" readonly value="TRF-{{count($allData)+1}}" id="field1">
<label for="field2">Gudang Asal</label>
<select class="form-control selectpicker" name="gudang_asal" id="gudang_id">
    <option value="">--- Pilih Gudang ---</option>
    @foreach($gudangs as $gudang)
    <option value="{{$gudang->id}}">{{$gudang->kode_gudang}}</option>
    @endforeach
</select>
<label for="field3">Gudang Tujuan</label>
<select class="form-control" name="gudang_tujuan" id="field3">
    <option value="">--- Pilih Gudang ---</option>
    @foreach($gudangs as $gudang)
    <option value="{{$gudang->id}}">{{$gudang->kode_gudang}}</option>
    @endforeach
</select>
<label for="field3">Deskripsi: </label>
<input class="form-control" type="text" name="deskripsi" id="field3">
<label for="field4">Departemen</label>
<input class="form-control" type="text" name="departemen" id="field4">
<label for="field5">Akun Penyesuaian</label>
<input class="form-control" type="text" name="akun_penyesuaian" id="field5">
<div id="formbarang" class="d-flex flex-column">
    <div id="isibarangs" class="d-flex m-2">
        <div class="m-3">
            <label for="field6">Barang</label>
            <select class="form-control isibarangs" name="barang_id[]" id="item_id">
                <option value="">--- Pilih Barang ---</option>
            </select>
        </div>
        <div class="m-3">
            <label for="field7">Jumlah Barang</label>
            <input id="field7" min="0" type="number" class="form-control" name="qty[]">
        </div>
    </div>
</div>
<div class="btn btn-primary btn-block" onclick="tambah()">Tambah Barang</div>


@endsection

@endsection


@section('scripts')
@parent

<script>
    let i = 0 
    function tambah(){
         let barangInput = $("#isibarangs").clone()
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
            $(".isibarangs").append('<option value="">--- Pilih Barang ---</option>')
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