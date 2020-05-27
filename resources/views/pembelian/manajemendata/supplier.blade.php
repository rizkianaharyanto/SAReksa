@extends('template.table')

@section('judul', 'Supplier')

@section('halaman', 'Supplier')

<!-- section('isi')
<a href="/supplier/create">Tambah Supplier</a>

endsection -->

@section('thead')
<tr>
    <th>Kode Supplier</th>
    <th>Nama Supplier</th>
    <th>Telp</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($suppliers as $supplier)
<tr>
    <td>{{ $supplier->kode_supplier }}</td>
    <td>{{ $supplier->nama_supplier }}</td>
    <td>{{ $supplier->telp_supplier }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $supplier->id }}">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" data-toggle="modal" data-target="#modal" data-id="{{ $supplier->id }}">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal" data-id="{{ $supplier->id }}">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a>
    </td>
</tr>
@endforeach

<!-- <script>
    $("a").click(function() {
        var ini = $(this).data("id");
        console.log(ini);
        $.get("/suppliers/"+ini, function(data) {
            // console.log(data);
            $('#nama_supplier').html("HELLO HELLO");
        });
    })
</script> -->

<script>
    $("a").click(function() {
        var id = $(this).attr("id");
        console.log(id);
        var ini = $(this).data("id");
        console.log(ini);
        $.get("/suppliers/" + ini, function(datanya) {
            //     console.log(datanya[0].nama_supplier);
            //     $('#nama_supplier').html("Supplier" + datanya[0].nama_supplier);
            // });
            if (id == "details") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i> ' +
                    '<h5 id = "nama_supplier" class = "align-self-center"> Supplier ' + datanya[0].nama_supplier + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset class="detail-modal" disabled>' +
                    '<div class="form-group">' +
                    '<label for="telp_supplier">Telp</label>' +
                    '<input type="number" class="form-control" id="telp_supplier" name="telp_supplier" placeholder="' + datanya[0].telp_supplier + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_supplier">Email</label>' +
                    '<input type="email" class="form-control" id="email_supplier" name="email_supplier" placeholder="' + datanya[0].email_supplier + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_supplier">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" placeholder="' + datanya[0].alamat_supplier + '">' +
                    '</div>' +
                    '</fieldset>' +
                    '</form>'
                );
                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>'
                );
            } else if (id == "edit") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').empty();
                $('#judulmodal').html(
                    '<h5 class="align-self-center">Edit Supplier ' + datanya[0].nama_supplier + '</h5>'
                );
                $('#bodymodal').html(
                    '<form method="POST" action="/suppliers/' + datanya[0].id + '">' +
                    '@method("patch")' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label for="nama_supplier">Nama</label>' +
                    '<input type="text" class="form-control" id="nama_supplier" value="' + datanya[0].nama_supplier + '" name="nama_supplier">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_supplier">Telp</label>' +
                    '<input type="number" class="form-control" id="telp_supplier" value="' + datanya[0].telp_supplier + '" name="telp_supplier">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_supplier">Email</label>' +
                    '<input type="email" class="form-control" id="email_supplier" value="' + datanya[0].email_supplier + '" name="email_supplier">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_supplier">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_supplier" value="' + datanya[0].alamat_supplier + '" name="alamat_supplier">' +
                    '</div>' +
                    '<div class="form-group modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<button type="submit" class="btn btn-primary">Simpan</button>' + 
                    '</div>' +
                    '</form>'
                );
            } else if (id == "delete") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<h5 class="align-self-center">Hapus Supplier</h5>'
                );
                $('#bodymodal').html(
                    '<p>Apakah kamu yakin ingin menghapus Supplier ' + datanya[0].nama_supplier + ' ?</p>'
                );
                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<form method="POST" action="/suppliers/' + datanya[0].id + '">' +
                    '@method("delete")' +
                    '@csrf' +
                    '<button type="submit" class="btn btn-danger">Hapus</button>' +
                    '</form>'
                );
            }
        });
    })
</script>
@endsection

<!-- Tambah -->
@section('tambah')
<a data-toggle="modal" data-target="#modaltambah">
    <i id="tambah" onmouseover="tulisan()" class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
@endsection

@section('judulTambah')
<h5 class="align-self-center">Tambah Supplier</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/suppliers">
    @csrf
    <div class="form-group d-inline-flex">
        <i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i>
        <input type="file" class="form-control-file align-self-center" id="foto">
    </div>
    <input type="hidden" id="kode_supplier" name="kode_supplier" placeholder="" value="SUP">
    <div class="form-group">
        <label for="nama_supplier">Nama Supplier</label>
        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="">
    </div>
    <div class="form-group">
        <label for="telp_supplier">Telp</label>
        <input type="number" class="form-control" id="telp_supplier" name="telp_supplier" placeholder="">
    </div>
    <div class="form-group">
        <label for="email_supplier">Email</label>
        <input type="email" class="form-control" id="email_supplier" name="email_supplier" placeholder="">
    </div>
    <div class="form-group">
        <label for="alamat_supplier">Alamat</label>
        <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" placeholder="">
    </div>

    @endsection