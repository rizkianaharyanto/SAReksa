@extends('penjualan.template.table', [
      'elementActive' => 'pelanggan'
])

@section('judul', 'Pelanggan')

@section('menu', 'Pelanggan')

@section('thead')
<tr>
    <th>Kode Pelanggan</th>
    <th>Nama Pelanggan</th>
    <th>Telp</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pelanggans as $pelanggan)
<tr>
    <td>{{ $pelanggan->kode_pelanggan }}</td>
    <td>{{ $pelanggan->nama_pelanggan }}</td>
    <td>{{ $pelanggan->telp_pelanggan }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $pelanggan->id }}">
            <i onmouseover="" style="cursor: pointer;" class="fas fa-info-circle" title="Details">
                <span></span>
            </i>
        </a>
        @if (auth()->user()->role == 'penjualan')
        <a id="edit" data-toggle="modal" data-target="#modal" data-id="{{ $pelanggan->id }}">
            <i onmouseover="" style="cursor: pointer;" class="fas fa-edit" title="Edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal" data-id="{{ $pelanggan->id }}">
            <i onmouseover="" style="cursor: pointer;" class="fas fa-trash" title="Delete">
                <span></span>
            </i>
        </a>
        @endif
    </td>
</tr>
@endforeach


<!-- <script>
    $("a").click(function() {
        var ini = $(this).data("id");
        console.log(ini);
        $.get("/pelanggans/"+ini, function(data) {
            // console.log(data);
            $('#nama_pelanggan').html("HELLO HELLO");
        });
    })
</script> -->

<script>
    $("a").click(function() {
        var id = $(this).attr("id");
        console.log(id);
        var ini = $(this).data("id");
        console.log(ini);
        $.get("/penjualan/pelanggans/" + ini, function(datanya) {
            console.log(datanya);
            //     console.log(datanya[0].nama_pelanggan);
            //     $('#nama_pelanggan').html("Pelanggan" + datanya[0].nama_pelanggan);
            // });
            if (id == "details") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#212120;"></i> ' +
                    '<h5 id = "nama_pelanggan" class = "align-self-center"> Pelanggan ' + datanya.pelanggan.nama_pelanggan + '</h5>'
                );
                $('#bodymodal').html(
                    '<form autocomplete="off">' +
                    '<fieldset class="detail-modal" disabled>' +
                    '<div class="form-group">' +
                    '<label for="telp_pelanggan">Telp</label>' +
                    '<input type="number" min="0"  class="form-control" id="telp_pelanggan" name="telp_pelanggan" placeholder="' + datanya.pelanggan.telp_pelanggan + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pelanggan">Email</label>' +
                    '<input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" placeholder="' + datanya.pelanggan.email_pelanggan + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_pelanggan">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" placeholder="' + datanya.pelanggan.alamat_pelanggan + '">' +
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
                    '<h5 class="align-self-center">Edit Pelanggan ' + datanya.pelanggan.nama_pelanggan + '</h5>'
                );
                $('#bodymodal').html(
                    '<form autocomplete="off" method="POST" action="/penjualan/pelanggans/' + datanya.pelanggan.id + '">' +
                    '@method("patch")' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label for="nama_pelanggan">Nama</label>' +
                    '<input type="text" class="form-control" id="nama_pelanggan" value="' + datanya.pelanggan.nama_pelanggan + '" name="nama_pelanggan">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_pelanggan">Telp</label>' +
                    '<input type="number" min="0"  class="form-control" id="telp_pelanggan" value="' + datanya.pelanggan.telp_pelanggan + '" name="telp_pelanggan">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pelanggan">Email</label>' +
                    '<input type="email" class="form-control" id="email_pelanggan" value="' + datanya.pelanggan.email_pelanggan + '" name="email_pelanggan">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_pelanggan">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_pelanggan" value="' + datanya.pelanggan.alamat_pelanggan + '" name="alamat_pelanggan">' +
                    '</div>' +
                    '<div class="form-group modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<button type="submit" style="background-color:#212120" class="btn ">Simpan</button>' + 
                    '</div>' +
                    '</form>'
                );
            } else if (id == "delete") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<h5 class="align-self-center">Hapus Pelanggan</h5>'
                );
                $('#bodymodal').html(
                    '<p>Apakah kamu yakin ingin menghapus Pelanggan ' + datanya.pelanggan.nama_pelanggan + ' ?</p>'
                );
                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<form method="POST" action="/penjualan/pelanggans/' + datanya.pelanggan.id + '">' +
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
@if (auth()->user()->role == 'penjualan')
<a data-toggle="modal" data-target="#modaltambah">
    <a data-toggle="modal" data-target="#modaltambah" class="btn" style="background-color:#212120; color:white" >Tambah</a>

</a>
@endif
@endsection

@section('judulTambah')
<h5 class="align-self-center">Tambah Pelanggan</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/penjualan/pelanggans" autocomplete="off">
    @csrf
    <div class="form-group d-inline-flex">
        <i class="fas fa-user-circle mr-4" style="font-size:50px;color:#212120;"></i>
    </div>
    <div class="form-group">
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="">
    </div>
    <div class="form-group">
        <label for="telp_pelanggan">Telp</label>
        <input type="number" min='0' class="form-control" id="telp_pelanggan" name="telp_pelanggan" placeholder="">
    </div>
    <div class="form-group">
        <label for="email_pelanggan">Email</label>
        <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" placeholder="">
    </div>
    <div class="form-group">
        <label for="alamat_pelanggan">Alamat</label>
        <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" placeholder="">
    </div>

    @endsection