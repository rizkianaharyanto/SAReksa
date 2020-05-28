@extends('template.table')

@section('judul', 'Akun')

@section('halaman', 'Akun')

@section('thead')
<tr>
    <th>Kode Akun</th>
    <th>Nama Akun</th>
    <th>Tipe Akun</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($akuns as $akun)
<tr>
    <td>{{ $akun->kode_akun }}</td>
    <td>{{ $akun->nama_akun }}</td>
    <td>{{ $akun->tipe_akun }}</td>
    <td class="d-flex justify-content-center">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $akun->id }}">
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
            $.get("/akuns/" + ini, function(datanya) {
                $('#lebarmodal').removeClass('modal-xl');
                $('#judulmodal').html(
                    '<h5 class="align-self-center">' + datanya[0].nama_akun + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset disabled>' +
                    '<div class="form-group">' +
                    '<label for="kode_akun">Kode Akun</label>' +
                    '<input type="text" id="kode_akun" name="kode_akun" class="form-control" placeholder="' + datanya[0].kode_akun + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="tipe_akun">Tipe Akun</label>' +
                    '<input type="text" id="tipe_akun" name="tipe_akun" class="form-control" placeholder="' + datanya[0].tipe_akun + '">' +
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