@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Masuk')

@section('table-header')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<tr>
    <th>Kode Penerimaan</th>
    <th>pemasok</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Variasi Barang</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection


@section('table-body')
@foreach ($penerimaans as $penerimaan)
<tr>
    <td>{{ $penerimaan->kode_penerimaan }}</td>
    <td>{{ $penerimaan->pemasok->nama_pemasok }}</td>
    <td>{{ $penerimaan->tanggal }}</td>
    <td>{{ $penerimaan->total_harga }}</td>
    <td>{{ $barangs }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/pembelian/stokmasuk/{{$penerimaan->id}}">
            <button class="btn-info">
                <i style="cursor: pointer; " class="fas fa-info-circle">
                    <span></span>
                </i>
            </button>
        </a>
    </td>
</tr>
@endforeach
@endsection


@section('scripts')
@parent

<script>
    $('#tambahbutton').hide()
    const title = "@yield('title')".toLowerCase().replace('data','').trim().replace(' ','-');
    const idSidebarLink = `link-${title}`.trim();
    console.log(idSidebarLink);
    $('#link-dashboard').removeClass('active');
    $(`#${idSidebarLink}`).addClass('active')
</script>

@endsection