@extends('template.table')

@section('judul', 'Gudang')

@section('halaman', 'Gudang')

@section('thead')
<tr>
    <th>Kode Gudang</th>
    <th>Nama Gudang</th>
    <th>Telp</th>
    <th>Status</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection

@section('tbody')
@foreach ($gudangs as $gudang)
<tr>
    <td>{{ $gudang->kode_gudang }}</td>
    <td>{{ $gudang->nama_gudang }}</td>
    <td>{{ $gudang->telp_gudang }}</td>
    <td>{{ $gudang->status_gudang }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" data-toggle="modal" data-target="#modal" data-id="{{ $gudang->id }}">
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
            $.get("/gudangs/" + ini, function(datanya) {
                $('#lebarmodal').removeClass('modal-xl');
                $('#judulmodal').html(
                    '<h5 class="align-self-center"> Gudang ' + datanya[0].nama_gudang + '</h5>'
                );
                $('#bodymodal').html(
                    '<form>' +
                    '<fieldset disabled>' +
                    '<div class="form-group">' +
                    '<label for="kode_gudang">Kode Gudang</label>' +
                    '<input type="text" id="kode_gudang" name="kode_gudang" class="form-control" placeholder="' + datanya[0].kode_gudang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="alamat_gudang">Alamat Gudang</label>' +
                    '<input type="text" id="alamat_gudang" name="alamat_gudang" class="form-control" placeholder="' + datanya[0].alamat_gudang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="telp_gudang">Telp</label>' +
                    '<input type="text" id="telp_gudang" telp="telp_gudang" class="form-control" placeholder="' + datanya[0].telp_gudang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="email_gudang">Email</label>' +
                    '<input type="text" id="email_gudang" email="email_gudang" class="form-control" placeholder="' + datanya[0].email_gudang + '">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="status_gudang">Status</label>' +
                    '<input type="text" id="status_gudang" status="status_gudang" class="form-control" placeholder="' + datanya[0].status_gudang + '">' +
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