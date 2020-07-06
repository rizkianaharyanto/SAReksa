@extends('pembelian.template.templatebaru')

@section('judul', 'dashboard')

@section('halaman', 'Dashboard')

@section('isi')

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><a href="/pembelian/barangs"><i class="fa fa-database text-danger border-danger"></i></a></div>
                <div class="stat-content dib">
                    <div class="stat-text">Barang</div>
                    <div class="stat-digit">{{$barangs}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><a href="/pembelian/gudangs"><i class="ti-layout-grid2 text-warning border-warning"></i></a></div>
                <div class="stat-content dib">
                    <div class="stat-text">Gudang</div>
                    <div class="stat-digit">{{$gudangs}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><a href="/pembelian/pengirims"><i class="ti-user text-success border-success"></i></a></div>
                <div class="stat-content dib">
                    <div class="stat-text">Pengirim</div>
                    <div class="stat-digit">{{$pengirims}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><a href="/pembelian/pemasoks"><i class="ti-user text-primary border-primary"></i></a></div>
                <div class="stat-content dib">
                    <div class="stat-text">Pemasok</div>
                    <div class="stat-digit">{{$pemasoks}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- pembelian -->
@if(auth()->user()->role->role_name == 'Admin Pembelian')
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <p class="text-light">Permintaan Penawaran</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/permintaans"><i class="fa fa-envelope-open-text text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <p class="text-light">Pemesanan Pembelian</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/pemesanans"><i class="fa fa-boxes text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <p class="text-light">Penerimaan Barang</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/penerimaans"><i class="fa fa-shipping-fast text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <p class="text-light">Faktur Pembelian</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/fakturs"><i class="fa fa-clipboard-check text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
@endif

<!-- retur -->
@if(auth()->user()->role->role_name == 'Admin Retur Pembelian')
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <p class="text-light">Faktur Pembelian</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/fakturs"><i class="fa fa-clipboard-check text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <p class="text-light">Retur Pembelian</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/returs"><i class="fa fa-exchange-alt text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
@endif

<!-- hutang -->
@if(auth()->user()->role->role_name == 'Admin Utang')
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <p class="text-light">Faktur Pembelian</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/fakturs"><i class="fa fa-clipboard-check text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <p class="text-light">Hutang</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/hutangs"><i class="fa fa-file-invoice-dollar text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <p class="text-light">Pembayaran Hutang</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/pembayarans"><i class="fa fa-hand-holding-usd text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
@endif

@if(auth()->user()->role->role_name == 'Direksi Perusahaan')
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <p class="text-light">Jurnal Khusus Pembelian</p>
            <div class="stat-widget-one mb-2 d-flex justify-content-center">
                <div class="stat-icon dib"><a href="/pembelian/jurnals"><i class="fa fa-file-alt text-light border-light"></i></a></div>
            </div>
        </div>
    </div>
</div>
<!--/.col-->
@endif
@endsection