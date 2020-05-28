@extends('template.table')

@section('judul', 'Pajak')

@section('halaman', 'Pajak')

@section('thead')
<tr>
    <th>Kode Pajak</th>
    <th>Nama Pajak</th>
    <th>Presentase</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($pajaks as $pajak)
<tr>
    <td>{{ $pajak->kode_pajak }}</td>
    <td>{{ $pajak->nama_pajak }}</td>
    <td>{{ $pajak->pajak }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $pajak->id }}">
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
            $.get("/pajaks/" + ini, function(datanya) {
                $('#lebarmodal').removeClass('modal-xl');
                $('#judulmodal').html(
                    '<h5 class="align-self-center">Pajak ' + datanya[0].nama_pajak + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset disabled>' +
                    '<div class="form-group">' +
                    '<label for="kode_pajak">Kode pajak</label>' +
                    '<input type="text" id="kode_pajak" name="kode_pajak" class="form-control" placeholder="' + datanya[0].kode_pajak + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="pajak">Persentase</label>' +
                    '<input type="text" id="pajak" name="pajak" class="form-control" placeholder="' + datanya[0].pajak + '%">' +
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