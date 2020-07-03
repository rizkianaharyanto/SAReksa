@extends('penjualan.template.table', [
      'elementActive' => 'barang'
])
@section('judul', 'Barang')

@section('menu','Barang') 
@section('halaman', 'Barang')

@section('thead')
<tr>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga Retail</th>
    <th>Stok Tersedia</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($data as $index => $barang)
<tr>
    <td>{{ $barang['kode_barang']}}</td>
    <td>{{ $barang['nama_barang']}}</td>
    <td>{{ $barang['harga_retail'] }}</td>
    <td>{{ $barang['kuantitas_total'] !=null ? $barang['kuantitas_total'] : '-' }}</td>
    <td class="d-flex justify-content-between">
        <a title="Details" id="details" data-toggle="modal" data-target="#modal" data-id="{{ $barang['id'] }}">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
    </td>
</tr>
@endforeach


<script>
    $("a").click(function() {
        var id = $(this).attr("id");
        console.log(id);
        var ini = $(this).data("id");
        console.log(ini);
        if (id == "details") {
            $.get("/stok/Management-Data/barang/" + ini, function(datanya) {
                console.log(datanya)
                $('#lebarmodal').removeClass('modal-xl');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#212120;"></i>' +
                    '<h5 class="align-self-center">' + datanya.nama_barang + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset disabled>' +
                    '<div class="form-group">' +
                    '<label for="kode_barang">Kode Barang</label>' +
                    '<input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="' + datanya.kode_barang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="kategori_barang">Kategori Barang</label>' +
                    '<input type="text" id="kategori_barang" name="kategori_barang" class="form-control" placeholder="' + datanya.kategori_barang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="jenis_barang">Jenis Barang</label>' +
                    '<input type="text" id="jenis_barang" jenis="jenis_barang" class="form-control" placeholder="' + datanya.jenis_barang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="harga_retail">Harga retail</label>' +
                    '<input type="text" id="harga_retail" harga="harga_retail" class="form-control" placeholder="' + datanya.harga_retail + '">' +
                    '</div>' +
                    '</div>' +
                    '</fieldset>' +
                    '</form>'
                );
                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>'
                );
            });
        }
    })
</script>

@endsection