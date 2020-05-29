@extends('pembelian.template.table')

@section('judul', 'Pengirim')

@section('halaman', 'Pengirim')

<!-- section('isi')
<a href="/pembelian/pengirim/create">Tambah Pengirim</a>
endsection -->

@section('thead')
<tr>
    <th>Kode Pengirim</th>
    <th>pemasok</th>
    <th>Nama Pengirim</th>
    <th>Telp</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pengirims as $pengirim)
<tr>
    <td>{{ $pengirim->kode_pengirim }}</td>
    <td>{{ $pengirim->pemasok->nama_pemasok }}</td>
    <td>{{ $pengirim->nama_pengirim }}</td>
    <td>{{ $pengirim->telp_pengirim }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $pengirim->id }}" data-sup="{{ $pengirim->pemasok->nama_pemasok }}">
            <i style="cursor: pointer;" class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" data-toggle="modal" data-target="#modal" data-id="{{ $pengirim->id }}" data-sup="{{ $pengirim->pemasok->nama_pemasok }}">
            <i style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal" data-id="{{ $pengirim->id }}">
            <i style="cursor: pointer;" class="fas fa-trash">
                <span></span>
            </i>
        </a>
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
        $.get("/pembelian/pengirims/" + ini, function(datanya) {
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
            var sup_id = datanya[index].pemasok_id
            // var supson = JSON.parse(sup_id)
            console.log(sup_id.toString())
            if (id == "details") {
                $('#lebarmodal').removeClass('modal-xl');
                $('#footermodal').addClass('modal-footer');
                $('#judulmodal').html(
                    '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i> ' +
                    '<h5 id = "nama_pengirim" class = "align-self-center">' + datanya[index].nama_pengirim + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset class="detail-modal" disabled>' +
                    '<div class="form-group">' +
                    '<label for="telp_pengirim">Telp</label>' +
                    '<input type="number" class="form-control" id="telp_pengirim" name="telp_pengirim" placeholder="' + datanya[index].telp_pengirim + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pengirim">Email</label>' +
                    '<input type="email" class="form-control" id="email_pengirim" name="email_pengirim" placeholder="' + datanya[index].email_pengirim + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="nama_pemasok">pemasok</label>' +
                    '<input type="text" class="form-control" id="nama_pemasok" name="nama_pemasok" placeholder="' + sup + '">' +
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
                    '<h5 class="align-self-center">Edit Pengirim ' + datanya[index].nama_pengirim + '</h5>'
                );
                $('#bodymodal').html(
                    '<form method="POST" action="/pembelian/pengirims/' + datanya[index].id + '">' +
                    '@method("patch")' +
                    '@csrf' +
                    '<div class="form-group">' +
                    '<label for="nama_pengirim">Nama</label>' +
                    '<input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="' + datanya[index].nama_pengirim + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_pengirim">Telp</label>' +
                    '<input type="number" class="form-control" id="telp_pengirim" name="telp_pengirim" value="' + datanya[index].telp_pengirim + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_pengirim">Email</label>' +
                    '<input type="email" class="form-control" id="email_pengirim" name="email_pengirim" value="' + datanya[index].email_pengirim + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="nama_pemasok">pemasok</label>' +
                    '<select class="form-control" id="nama_pemasok"  name="pemasok_id">' +
                    '<option value="">--- Pilih pemasok ---</option>' +
                    '@foreach ($pemasoks as $pemasok)' +
                    '<option value="{{$pemasok->id}}" {{$pemasok->id == "'+sup_id.toString()+'" ? "selected" : ""}} >{{$pemasok->nama_pemasok}}</option>' +
                    '@endforeach' +
                    '</select>' +
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
                    '<h5 class="align-self-center">Hapus Pengirim</h5>'
                );
                $('#bodymodal').html(
                    '<p>Apakah kamu yakin ingin menghapus Pengirim ' + datanya[index].nama_pengirim + ' ?</p>'
                );

                $('#footermodal').html(
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                    '<form method="POST" action="/pembelian/pengirims/' + datanya[index].id + '">' +
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
<a data-toggle="modal" data-target="#modaltambah">
    <i id="tambah" class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
    </i>
</a>
@endsection

@section('judulTambah')
<h5 class="align-self-center">Tambah Pengirim</h5>
@endsection

@section('bodyTambah')

<form method="POST" action="/pembelian/pengirims">
    @csrf
    <div class="form-group d-inline-flex">
        <i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i>
        <input type="file" class="form-control-file align-self-center" id="foto">
    </div>
    <input type="hidden" id="kode_pengirim" name="kode_pengirim" placeholder="" value="PENG">
    <div class="form-group">
        <label for="nama_pengirim">Nama pengirim</label>
        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="">
    </div>
    <div class="form-group">
        <label for="telp_pengirim">Telp</label>
        <input type="number" class="form-control" id="telp_pengirim" name="telp_pengirim" placeholder="">
    </div>
    <div class="form-group">
        <label for="email_pengirim">Email</label>
        <input type="email" class="form-control" id="email_pengirim" name="email_pengirim" placeholder="">
    </div>
    <div class="form-group">
        <label for="nama_pemasok">pemasok</label>
        <select class="form-control" id="nama_pemasok" name="pemasok_id">
            <option value="">--- Pilih pemasok ---</option>
            @foreach ($pemasoks as $pemasok)
            <option value="{{$pemasok->id}}">{{ $pemasok->nama_pemasok }}</option>
            @endforeach
        </select>
    </div>

    @endsection