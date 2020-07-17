@extends('pembelian.template.table')

@section('judul', 'Hutang')

@section('halaman', 'Hutang')

@section('path')
<li class="active"><a href="#">Hutang</a></li>
@endsection

@section('isi')
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body ">
            <p class="text-light">Hutang Berdasarkan Pemasok</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/hutangs"><i class="ti-user text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-5">
        <div class="card-body ">
            <p class="text-light">Hutang Berdasarkan Faktur</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/hutangs-faktur"><i class="fa fa-clipboard-check text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
@endsection