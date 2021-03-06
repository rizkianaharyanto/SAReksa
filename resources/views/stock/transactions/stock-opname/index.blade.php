@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Opname')

@section('table-header')
<tr>
    <th>Tanggal</th>
    <th>Kode Referensi</th>
    <th>Gudang</th>
    <th>Deskripsi</th>
    <th>Departemen</th>
    <th>Status</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')
@foreach ($stokOp as $i=> $op)
<tr>
    <td>{{$op->created_at->toDateString()}}</td>
    <td>{{ $op->kode_ref }}</td>
    <td>{{ $op->gudang->kode_gudang}}</td>
    <td> {{ $op->deskripsi }} </td>
    <td> {{ $op->departemen }} </td>
    <td>{{$op->status}}</td>
    <td>
        <center>
            <div class="dropright">

                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item " href="/stok/stock-opname/{{$op->id}}">Details</a>
                    @if($op->status != 'sudah posting')
                    <a class="dropdown-item" href="/stok/stock-opname/{{$op->id}}/edit"> Edit</a>
                    {{-- <a class="delete-jquery dropdown-item" data-method="delete"
                        href="{{ route('barang.destroy', $op->id ) }}">Delete</a> --}}
                    <a class="dropdown-item " href="/stok/stock-opname/posting/{{$op->id}}">Posting</a>
                    @endif
                </div>
            </div>
        </center>
    </td>
</tr>
@endforeach
@endsection

@section('modal-form')
@parent
@section('modal-content')

@section('modal-form-action','/stok/stock-opname')
@section('modal-form-method','POST')

<label for="field1">Kode Referensi </label>
<input class="form-control" value="STK-{{count($stokOp)+1}}" type="text" name="kode_ref" id="field1" readonly>
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
{{-- <label for="field4">akun_penyesuaian</label>
<input class="form-control" type="text" name="akun_penyesuaian" id="field3"> --}}
<div id="formbarang" class="d-flex flex-column">
    <div class="d-flex inputbarangs">
        <div class="m-3">
            <label for="field4">Barang</label>
            <select class="form-control  isibarangs" name="item_id[]">
                <option value="">--- Pilih Barang ---</option>
            </select>
        </div>
        <div class="m-3">
            <label for="field4">Hasil Stok Opname</label>
            <input type="number" class="form-control" min="0" name="on_hand[]">
        </div>

    </div>

</div>
<div class="btn btn-primary btn-block" onclick="tambah()">Tambah Barang</div>

@endsection

@endsection


@section('scripts')
@parent

<script>
    $('#link-dashboard').removeClass('active');

    let i = 0

    function tambah() {
        let selected = $('.inputbarangs').last().find('option:selected').val();
        let barangInput = $(".inputbarangs").last().clone()
        barangInput.find('option').each(function (index,data){
            if($(this).val() == selected)
            {
                $(this).remove();
            }
        });

        if ($(".inputbarangs").last().is(':first-child')) {
            $("#formbarang").append(barangInput);
            
            $("#formbarang").find('.inputbarangs').last().append(' <a type="button" class="m-3 pt-4" onclick="hapus(this)"><i class="fas fa-window-close" style="color: red; cursor: pointer"></i></a>');
        }
        else{
            $("#formbarang").append(barangInput);
            
        }
    }

    function hapus(x) {
        $(x).parent().remove()
    }
    $("#gudang_id").change(function() {
        $.ajax({
            url: '/stok/getstocksbywarehouse/' + $(this).val(),
            type: 'get',
            retur: {},
            success: function(data) {
                $(".isibarangs").empty();
                $(".isibarangs").append('<option value="test">--- Pilih Barang ---</option>')
                let alreadySelectedItem = null;
                $(`.isibarangs`).change(function() {
                    
                    alreadySelectedItem = $(`.isibarangs`).last().find('option:selected').val();
                })
                    console.log(alreadySelectedItem);
                for (i = 0; i < data.length; i++) {
                    $(".isibarangs").append(`<option value="${data[i].barang.id}" data-kuantitas=${data[i].kuantitas} >` + data[i].barang.nama_barang + `       \t(${data[i].kuantitas})`+'</option>')
                }
            }
        })
    })

    $(".isibarangs").change(function()  {
        let selectedBarang = $(this).find('option:selected');
        let kuantitasBarang = selectedBarang.data('kuantitas');
        
    })
</script>
<script>
    const title = "@yield('title')".toLowerCase().replace('data', '').trim().replace(' ', '-');
    const idSidebarLink = `link-${title}`.trim();
    $(`#${idSidebarLink}`).addClass('active')
</script>
@endsection