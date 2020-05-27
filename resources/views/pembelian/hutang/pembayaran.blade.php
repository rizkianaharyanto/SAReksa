@extends('template.table')

@section('judul', 'Pembayaran Hutang')

@section('halaman', 'Pembayaran Hutang')

@section('thead')
<tr>
    <th>Kode Pembayaran</th>
    <th>Supplier</th>
    <th>Total</th>
    <th>Tanggal</th>
    <th>Akun</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pembayarans as $pembayaran)
<tr>
    <td>{{ $pembayaran->kode_pembayaran }}</td>
    <td>Supplier</td>
    <td>{{ $pembayaran->total }}</td>
    <td>{{ $pembayaran->tanggal }}</td>
    <td>Akun</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-info-circle">
                <span></span>
            </i>
        </a>
        <a id="edit" data-toggle="modal" data-target="#modal">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-edit">
                <span></span>
            </i>
        </a>
        <a id="delete" data-toggle="modal" data-target="#modal">
            <i onmouseover="tulisan()" style="cursor: pointer;" class="fas fa-trash">
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
        if (id == "details") {
            // $('#lebarmodal').addClass('modal-xl');
            $('#judulmodal').html(
                '<h5 id ="nama_supplier" class = "align-self-center"> Supplier </h5>'
            );
            $('#bodymodal').html(
                '<form>' +
                '<fieldset class="detail-modal" disabled>' +
                '<div class="form-group ">' +
                '<label for="disabledTextInput">Email</label>' +
                '<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="disabledTextInput">Telp</label>' +
                '<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">' +
                '</div>' +
                '</fieldset>' +
                '</form>'
            );
            $('#footermodal').html(
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>'
            );
        } else if (id == "edit") {
            $('#judulmodal').html(
                '<h5 class="align-self-center">Edit Pembayaran</h5>'
            );
            $('#bodymodal').html(
                '<form>' +
                '<div class="form-group d-inline-flex">' +
                '<i class="fas fa-user-circle mr-4" style="font-size:50px;color:#00BFA6;"></i>' +
                '<input type="file" class="form-control-file align-self-center" id="exampleFormControlFile1">' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="exampleFormControlInput1">Email</label>' +
                '<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">' +
                '</div>' +
                '<div class="form-group">' +
                '<label for = "exampleFormControlInput1" > Telp </label>' +
                '<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">' +
                '</div>' +
                '</form>'
            );
            $('#footermodal').html(
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                '<button type="button" class="btn btn-primary">Simpan</button>'
            );
        } else if (id == "delete") {
            $('#judulmodal').html(
                '<h5 class="align-self-center">Hapus Pembayaran</h5>'
            );
            $('#bodymodal').html(
                '<p>Apakah kamu yakin ingin menghapus Pembayaran A ?</p>'
            );
            $('#footermodal').html(
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>' +
                '<button type="button" class="btn btn-danger">Hapus</button>'
            );
        }
    })
</script>

@endsection