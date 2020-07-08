@extends('stock.transactions.layout')

@section('css')
@parent
@endsection


@section('title','Stok Keluar')

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
    <th>Kode pengiriman</th>
    <th>Pelanggan</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Variasi Barang</th>
    <th style="column-width: 80px">Aksi</th>
</tr>
@endsection


@section('table-body')
@foreach ($pengirimans as $pengiriman)
<tr>
    <td>{{ $pengiriman->kode_pengiriman }}</td>
    <td>{{ $pengiriman->pelanggan->nama_pelanggan }}</td>
    <td>{{ $pengiriman->tanggal }}</td>
    <td>{{ $pengiriman->total_harga }}</td>
    <td>{{ $barangs }}</td>
    <td class="d-flex justify-content-between">
        <a id="details" href="/penjualan/stokkeluar/{{$pengiriman->id}}">
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
</script>
@endsection