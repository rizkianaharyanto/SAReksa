@extends('pembelian.template.table')

@section('judul', 'pemasok')

@section('halaman', 'pemasok')

<!-- section('isi')
<a href="/pembelian/pemasok/create">Tambah pemasok</a>

endsection -->

@section('thead')
<tr>
    <th>Kode pemasok</th>
    <th>Nama pemasok</th>
    <th>Telp</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pemasoks as $pemasok)
<tr>
    <td>{{ $pemasok->kode_pemasok }}</td>
    <td>{{ $pemasok->nama_pemasok }}</td>
    <td>{{ $pemasok->telp_pemasok }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $pemasok->id }}">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" data-toggle="modal" data-target="#modal" data-id="{{ $pemasok->id }}">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal" data-id="{{ $pemasok->id }}">
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
        $.get("/pembelian/pemasoks/"+ini, function(data) {
            // console.log(data);
            $('#nama_pemasok').html("HELLO HELLO");
        });
    })
</script> -->

<script>
    $("a").click(function() {
        var id = $(this).attr("id");
        console.log(id);
        var ini = $(this).data("id");
        console.log(ini);
        $.get("/pembelian/pemasoks/" + ini, function(datanya) {
                console.log(datanya);
            //     $('#nama_pemasok').html("pemasok" + datanya[0].nama_pemasok);
            // });
            if (id == "details") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i> ' +
                    '<h5 id = "nama_pemasok" class = "align-self-center"> pemasok ' + datanya[0].nama_pemasok + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset class="detail-modal" disabled>' +
                    '<div class="form-group">' +
                    '<label for="telp_pemasok">Telp</label>' +
                    '<input type="number" class="form-control" id="telp_pemasok" name="telp_pemasok" placeholder="' + datanya[0].telp_pemasok + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pemasok">Email</label>' +
                    '<input type="email" class="form-control" id="email_pemasok" name="email_pemasok" placeholder="' + datanya[0].email_pemasok + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_pemasok">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_pemasok" name="alamat_pemasok" placeholder="' + datanya[0].alamat_pemasok + '">' +
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
                    '<h5 class="align-self-center">Edit pemasok ' + datanya[0].nama_pemasok + '</h5>'
                );
                $('#bodymodal').html(
                    '<form method="POST" action="/pembelian/pemasoks/' + datanya[0].id + '">' +
                    '@method("patch")' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label for="nama_pemasok">Nama</label>' +
                    '<input type="text" class="form-control" id="nama_pemasok" value="' + datanya[0].nama_pemasok + '" name="nama_pemasok">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_pemasok">Telp</label>' +
                    '<input type="number" class="form-control" id="telp_pemasok" value="' + datanya[0].telp_pemasok + '" name="telp_pemasok">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pemasok">Email</label>' +
                    '<input type="email" class="form-control" id="email_pemasok" value="' + datanya[0].email_pemasok + '" name="email_pemasok">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_pemasok">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_pemasok" value="' + datanya[0].alamat_pemasok + '" name="alamat_pemasok">' +
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
                    '<h5 class="align-self-center">Hapus pemasok</h5>'
                );
                $('#bodymodal').html(
                    '<p>Apakah kamu yakin ingin menghapus pemasok ' + datanya[0].nama_pemasok + ' ?</p>'
                );
                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<form method="POST" action="/pembelian/pemasoks/' + datanya[0].id + '">' +
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
<h5 class="align-self-center">Tambah pemasok</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/pembelian/pemasoks">
    @csrf
    <div class="form-group d-inline-flex">
        <i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i>
        <input type="file" class="form-control-file align-self-center" id="foto">
    </div>
    <input type="hidden" id="kode_pemasok" name="kode_pemasok" placeholder="" value="SUP">
    <div class="form-group">
        <label for="nama_pemasok">Nama pemasok</label>
        <input type="text" class="form-control" id="nama_pemasok" name="nama_pemasok" placeholder="">
    </div>
    <div class="form-group">
        <label for="telp_pemasok">Telp</label>
        <input type="number" class="form-control" id="telp_pemasok" name="telp_pemasok" placeholder="">
    </div>
    <div class="form-group">
        <label for="email_pemasok">Email</label>
        <input type="email" class="form-control" id="email_pemasok" name="email_pemasok" placeholder="">
    </div>
    <div class="form-group">
        <label for="alamat_pemasok">Alamat</label>
        <input type="text" class="form-control" id="alamat_pemasok" name="alamat_pemasok" placeholder="">
    </div>

    @endsection