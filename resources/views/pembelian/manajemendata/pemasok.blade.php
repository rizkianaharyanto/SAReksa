@extends('pembelian.template.table')

@section('judul', 'Pemasok')

@section('halaman', 'Pemasok')

@section('path')
<li><a href="#">Manajemen Data</a></li>
<li class="active">Data Pemasok</li>
@endsection

<!-- section('isi')
<a href="/pembelian/pemasok/create">Tambah pemasok</a>

endsection -->

@section('thead')
<tr>
    <th>Kode Pemasok</th>
    <th>Nama Pemasok</th>
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
            <button class="btn-info"><i style="cursor: pointer;" class="fas fa-info-circle">
                    <span></span>
                </i></button>
        </a>

        @if(auth()->user()->role->role_name == 'Admin Pembelian')
        <a id="edit" data-toggle="modal" data-target="#modal" data-id="{{ $pemasok->id }}">
            <button class="btn-warning"><i style="cursor: pointer;" class="fas fa-edit">
                    <span></span>
                </i></button>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal" data-id="{{ $pemasok->id }}">
            <button class="btn-danger"><i style="cursor: pointer;" class="fas fa-trash">
                    <span></span>
                </i></button>
        </a>
        @endif
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
            //     $('#nama_pemasok').html("pemasok" + datanya.pemasok.nama_pemasok);
            // });
            if (id == "details") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i> ' +
                    '<h5 id = "nama_pemasok" class = "align-self-center"> Pemasok ' + datanya.pemasok.nama_pemasok + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset class="detail-modal" disabled>' +
                    '<div class="form-group">' +
                    '<label for="telp_pemasok">Telp</label>' +
                    '<input type="number" min="0" class="form-control" id="telp_pemasok" name="telp_pemasok" placeholder="' + datanya.pemasok.telp_pemasok + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pemasok">Email</label>' +
                    '<input type="email" class="form-control" id="email_pemasok" name="email_pemasok" placeholder="' + datanya.pemasok.email_pemasok + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_pemasok">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_pemasok" name="alamat_pemasok" placeholder="' + datanya.pemasok.alamat_pemasok + '">' +
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
                    '<h5 class="align-self-center">Edit Pemasok ' + datanya.pemasok.nama_pemasok + '</h5>'
                );
                $('#bodymodal').html(
                    '<form method="POST" action="/pembelian/pemasoks/' + datanya.pemasok.id + '">' +
                    '@method("patch")' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label for="nama_pemasok">Nama</label>' +
                    '<input type="text" required class="form-control" id="nama_pemasok" value="' + datanya.pemasok.nama_pemasok + '" name="nama_pemasok">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_pemasok">Telp</label>' +
                    '<input type="number" required min="0" class="form-control" id="telp_pemasok" value="' + datanya.pemasok.telp_pemasok + '" name="telp_pemasok">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pemasok">Email</label>' +
                    '<input type="email" required class="form-control" id="email_pemasok" value="' + datanya.pemasok.email_pemasok + '" name="email_pemasok">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_pemasok">Alamat</label>' +
                    '<input type="text" required class="form-control" id="alamat_pemasok" value="' + datanya.pemasok.alamat_pemasok + '" name="alamat_pemasok">' +
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
                    '<h5 class="align-self-center">Hapus Pemasok</h5>'
                );
                $('#bodymodal').html(
                    '<p>Apakah kamu yakin ingin menghapus Pemasok ' + datanya.pemasok.nama_pemasok + ' ?</p>'
                );
                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<form method="POST" action="/pembelian/pemasoks/' + datanya.pemasok.id + '">' +
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


@if(auth()->user()->role->role_name == 'Admin Pembelian')
<!-- Tambah -->
@section('tambah')
<a data-toggle="modal" data-target="#modaltambah">
    <button class="btn-sm btn-info">Tambah</button>
</a>
@endsection
@endif

@section('judulTambah')
<h5 class="align-self-center">Tambah Pemasok</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/pembelian/pemasoks">
    @csrf
    <!-- <div class="form-group d-inline-flex">
        <i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i>
        <input type="file" class="form-control-file align-self-center" id="foto">
    </div> -->
    <div class="form-group">
        <label for="nama_pemasok">Nama Pemasok</label>
        <input type="text" required class="form-control" id="nama_pemasok" name="nama_pemasok" placeholder="">
    </div>
    <div class="form-group">
        <label for="telp_pemasok">Telp</label>
        <input type="number" required class="form-control" id="telp_pemasok" min="0" name="telp_pemasok" placeholder="">
    </div>
    <div class="form-group">
        <label for="email_pemasok">Email</label>
        <input type="email" required class="form-control" id="email_pemasok" name="email_pemasok" placeholder="">
    </div>
    <div class="form-group">
        <label for="alamat_pemasok">Alamat</label>
        <input type="text" required class="form-control" id="alamat_pemasok" name="alamat_pemasok" placeholder="">
    </div>

    @endsection