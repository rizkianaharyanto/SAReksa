@extends('penjualan.template.table', [
      'elementActive' => 'sales'
])

@section('judul', 'Sales')

@section('menu', 'Sales')

@section('thead')
<tr>
    <th>Kode Sales</th>
    <th>Nama Sales</th>
    <th>Telp</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($penjuals as $penjual)
<tr>
    <td>{{ $penjual->kode_penjual }}</td>
    <td>{{ $penjual->nama_penjual }}</td>
    <td>{{ $penjual->telp_penjual }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $penjual->id }}" >
            <i style="cursor: pointer;" class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        @if (auth()->user()->role == 'penjualan')
        <a id="edit" data-toggle="modal" data-target="#modal" data-id="{{ $penjual->id }}" >
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal" data-id="{{ $penjual->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a>
        @endif
    </td>
</tr>
@endforeach


<script>
    $("a").click(function() {
        var id = $(this).attr("id");
        // console.log(id);
        var sup = $(this).data('sup')
        var ini = $(this).data("id");
        console.log(sup);
        $.get("/penjualan/penjuals/" + ini, function(datanya) {
            console.log(datanya);
            if (datanya.length == 2) {
                var kecil = datanya[0].id
                var gede = datanya[1].id
                if (ini == kecil) {
                    var index = 0
                } else if (ini == gede) {
                    index = 1
                }
            } else {
                index = 0
            }
            if (id == "details") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#212120;"></i> ' +
                    '<h5 id = "nama_penjual" class = "align-self-center">' + datanya[index].nama_penjual + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset class="detail-modal" disabled>' +
                    '<div class="form-group">' +
                    '<label for="telp_penjual">Telp</label>' +
                    '<input type="number" min="0"  class="form-control" id="telp_penjual" name="telp_penjual" placeholder="' + datanya[index].telp_penjual + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_penjual">Email</label>' +
                    '<input type="email" class="form-control" id="email_penjual" name="email_penjual" placeholder="' + datanya[index].email_penjual + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_penjual">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_penjual" name="alamat_penjual" placeholder="' + datanya[index].alamat_penjual + '">' +
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
                    '<h5 class="align-self-center">Edit Sales ' + datanya[index].nama_penjual + '</h5>'
                );
                $('#bodymodal').html(
                    '<form autocomplete="off" method="POST" action="/penjualan/penjuals/' + datanya[index].id + '">' +
                    '@method("patch")' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label for="nama_penjual">Nama</label>' +
                    '<input type="text" class="form-control" id="nama_penjual" name="nama_penjual" value="' + datanya[index].nama_penjual + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_penjual">Telp</label>' +
                    '<input type="number" min="0" class="form-control" id="telp_penjual" name="telp_penjual" value="' + datanya[index].telp_penjual + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_penjual">Email</label>' +
                    '<input type="email" class="form-control" id="email_penjual" name="email_penjual" value="' + datanya[index].email_penjual + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_penjual">Alamat</label>' +
                    '<input type="text" class="form-control" id="alamat_penjual" value="' + datanya[index].alamat_penjual + '" name="alamat_penjual">' +
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
                    '<h5 class="align-self-center">Hapus Sales</h5>'
                );
                $('#bodymodal').html(
                    '<p>Apakah kamu yakin ingin menghapus Sales ' + datanya[index].nama_penjual + ' ?</p>'
                );

                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<form method="POST" action="/penjualan/penjuals/' + datanya[index].id + '">' +
                    '@method("delete")' +
                    '@csrf' +
                    '<button type="submit" class="btn btn-danger">Hapus</button>' +
                    '</form>'
                );
            }
        })
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
<h5 class="align-self-center">Tambah Sales</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/penjualan/penjuals" autocomplete="off">
    @csrf
    <div class="form-group d-inline-flex">
        <i class="fas fa-user-circle mr-4" style="font-size:50px;color:#212120;"></i>
    </div>
    <div class="form-group">
        <label for="nama_penjual">Nama penjual</label>
        <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder="">
    </div>
    <div class="form-group">
        <label for="telp_penjual">Telp</label>
        <input type="number" min="0" class="form-control" id="telp_penjual" name="telp_penjual" placeholder="">
    </div>
    <div class="form-group">
        <label for="email_penjual">Email</label>
        <input type="email" class="form-control" id="email_penjual" name="email_penjual" placeholder="">
    </div>
    <div class="form-group">
        <label for="alamat_penjual">Alamat</label>
        <input type="text" class="form-control" id="alamat_penjual" name="alamat_penjual" placeholder="">
    </div>

    @endsection