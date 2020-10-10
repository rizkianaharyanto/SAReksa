@extends('stock.management-data.layout')
@section('css')
@parent

@endsection
@section('title','Data Pemasok')

@section('button-tambah-data','')

@section('table-header')

<tr>
    <th>Kode Pemasok</th>
    <th>Nama Pemasok</th>
    <th>Telp</th>
    <th>Email</th>
    <th>Alamat</th>
</tr>
@endsection

@section('tableButtons', '')

@section('table-body')


@foreach ($pemasoks as $pemasok)
<tr>
    <td>{{ $pemasok->kode_pemasok }}</td>
    <td>{{ $pemasok->nama_pemasok }}</td>
    <td>{{ $pemasok->telp_pemasok }}</td>
    <td>{{ $pemasok->email_pemasok }}</td>
    <td>{{ $pemasok->alamat_pemasok }}</td>
</tr>

@endforeach

@endsection



@section('modalId')
modalGudang
@endsection

@section('modalForm')
<label for="kodePemasok">Kode Pemasok </label>
<input class="form-control" type="text" name="kode_supplier" id="field1" value="">
<label for="namaPemasok">Nama Pemasok </label>
<input class="form-control" type="text" name="nama_supplier" id="field2">
<label for="Alamat">Alamat </label>
<textarea class="form-control" type="textarea" name="alamat" id="field3" rows="5"></textarea>
<label for="noTelp">No Telpon: </label>
<input class="form-control" type="text" name="no_telp" id="field4">
@endsection

@section('scripts')
@parent
<script>
    const title = "@yield('title')".toLowerCase().replace('data','').trim();
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#link-manajemen-data`).addClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>
@endsection