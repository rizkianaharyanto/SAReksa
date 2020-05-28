@extends('template.table')

@section('judul', 'Barang')

@section('halaman', 'Barang')

@section('thead')
<tr>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga Barang</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($barangs as $barang)
<tr>
    <td>{{ $barang->kode_barang }}</td>
    <td>{{ $barang->nama_barang }}</td>
    <td>{{ $barang->harga_barang }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $barang->id }}">
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
            $.get("/barangs/" + ini, function(datanya) {
                $('#lebarmodal').removeClass('modal-xl');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i>' +
                    '<h5 class="align-self-center">' + datanya[0].nama_barang + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset disabled>' +
                    '<div class="form-group">' +
                    '<label for="kode_barang">Kode Barang</label>' +
                    '<input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="' + datanya[0].kode_barang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="kategori_barang">Kategori Barang</label>' +
                    '<input type="text" id="kategori_barang" name="kategori_barang" class="form-control" placeholder="' + datanya[0].kategori_barang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="jenis_barang">Jenis Barang</label>' +
                    '<input type="text" id="jenis_barang" jenis="jenis_barang" class="form-control" placeholder="' + datanya[0].jenis_barang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="harga_barang">Harga Barang</label>' +
                    '<input type="text" id="harga_barang" harga="harga_barang" class="form-control" placeholder="' + datanya[0].harga_barang + '">' +
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