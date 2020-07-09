@extends('pembelian.template.table')

@section('judul', 'Penerimaan Barang')

@section('halaman', 'Penerimaan Barang')

@section('path')
<li><a href="#">Transaksi</a></li>
<li class="active">Penerimaan</li>
@endsection

@section('isi')
<div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success m-2">Success</span>Lanjutkan posting ke Jurnal Transaksi Pembelian
    </div>
</div>
<center>
    <a href="/pembelian/ubahpsn/{{$id}}"><button class="btn btn-dark">Posting</button></a>
</center>
@endsection