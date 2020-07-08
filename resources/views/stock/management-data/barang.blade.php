@extends('stock.management-data.layout')
@section('title','Data Barang')
@section('css')
@parent
@endsection
@section('button-tambah-data')
<button class="btn btn-info" style="background-color: #349eac" data-toggle="modal" data-target="#exampleModal"> Tambah
    Data Barang</button>

@endsection
@section('table-header')


<tr>
    <th>No.</th>
    <th>Kode Barang</th>
    <th>Kategori Barang</th>
    <th>Nama Barang</th>
    <th>Satuan Unit</th>
    <th>Harga Beli Per Satuan</th>
    <th>Harga Jual Per Satuan</th>
    <th>Nilai Barang</th>
    <th>Jumlah Barang</th>
    <th>Created at</th>
    <th>Updated At</th>
    <th>Opsi</th>
</tr>
@endsection


@section('table-body')


@foreach($barang as $index => $i)

<tr>
    <td>{{ $index+1 }}</td>
    <td>{{ $i['kode_barang'] }}</td>
    <td>{{ $i['kategori_barang'] }}</td>
    <td>{{ $i['nama_barang'] }}</td>
    <td>{{ $i['satuan'] }}</td>
    <td class="harga">{{$i['harga_retail']}}</td>
    <td class="harga">{{$i['harga_jual']}}</td>

    <td class="harga">{{$i['nilai_barang']}}</td>
    <td>@if($i['kuantitas_total']){{$i['kuantitas_total']}} @else 0 @endif</td>
    <td class=>{{date('d-m-Y',strtotime($i['created_at']))}}</td>
    <td class=>{{date('d-m-Y',strtotime($i['updated_at']))}}</td>


    <td>

        <div class="dropright">

            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="menu-icon fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item" data-toggle="modal" data-target="#modalDetailBarang"
                    data-barang="{{$barangDetails[$index]}}" data-form="Edit Data">
                    Edit</a>
                <a class="delete-jquery dropdown-item" data-toggle="modal"
                    data-target="#modalDelete{{$i['id']}}">Delete</a>
                <a class="dropdown-item " data-toggle="modal" data-target="#modalDetailBarang"
                    data-barang="{{$barangDetails[$index]}}" href="#">Details</a>

                <!-- <a class="delete-jquery">Delete</a> -->
            </div>
        </div>
    </td>


</tr>

@php
$action = '/stok/Management-Data/barang/'.$i['id'];

@endphp
<x-stock.modal-stock-delete :deleteAction="$action" :id="$i['id']">
    <x-slot name="header">
        {{$i['nama_barang']}}
    </x-slot>
    <x-slot name="body">
        Seluruh Stok Barang Akan Terhapus Jika Anda Menghapus Barang Ini
    </x-slot>
</x-stock.modal-stock-delete>


@endforeach
@endsection



@section('modalForm')


@endsection
<x-stock.modal-detail-barang>

</x-stock.modal-detail-barang>
<x-stock.stepper-barang :kategoriBarang="$kategoriBarang" :satuanUnit="$satuanUnit" :gudangs="$gudangs">
</x-stock.stepper-barang>

@section('scripts')
@parent


<script>
    var table = $('#example');
 
    $('.dt-buttons').remove();
</script>
<script>
    $('#modalDetailBarang').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var barang = button.data('barang')
        console.log(barang.item_image); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text(`Detail Barang ${barang.nama_barang}`)
        modal.find('.modal-body #item-image').attr('src',`/storage/${barang.item_image}`);
        modal.find('.modal-body #kategoriBarang p').html(barang.kategori.nama_kategori)
        modal.find('.modal-body #namaBarang h3').html(barang.nama_barang)
        modal.find('.modal-body #satuanUnit p').html(barang.unit.nama_satuan)
        modal.find('.modal-body #kodeBarang p').html(barang.kode_barang)
        let hargaGrosir = new Intl.NumberFormat('en-ID', { style: 'currency', currency: 'IDR' }).format(barang.harga_grosir)
        let hargaRetail = new Intl.NumberFormat('en-ID', { style: 'currency', currency: 'IDR' }).format(barang.harga_retail)
        
        modal.find('.modal-body #hargaGrosir p').html(`${hargaGrosir}`)
        modal.find('.modal-body #hargaRetail p').html(hargaRetail)

        
        
        })
</script>
<script src="{{asset('js/stock/jquery.mask.min.js')}}"></script>
<script>
    const title = "@yield('title')".toLowerCase().replace('data', '').trim();
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#link-manajemen-data`).addClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
<script>
    $('.harga').html();
    $('.harga').mask('000.000.000.000', {
        reverse: true
    });
</script>
@endsection