<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Manajemen Pembelian</title>
    <!-- <meta name="description" content="Sufee Admin - HTML5 Admin Template"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{url('css/pembelian/apple-icon.png')}}">
    <link rel="shortcut icon" href="{{url('css/pembelian/favicon.ico')}}">

    <link rel="stylesheet" href="{{url('/css/pembelian/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/pembelian/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{url('/css/pembelian/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{url('css/pembelian/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/jqvmap/dist/jqvmap.min.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/DataTables/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/tables.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="{{url('css/pembelian/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">

    <!-- <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/sidebar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/page.css') }}" /> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dataTables.bootstrap4.min.css') }}" />
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/DataTables/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/tables.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ url('/css/pembelian/DataTables/datatables.min.js') }}"></script>


    <script src="{{url('css/pembelian/vendors/chart.js/dist/Chart.bundle.min.js')}}"></script>
    <script src="{{url('css/pembelian/assets/js/dashboard.js')}}"></script>
    <script src="{{url('css/pembelian/assets/js/widgets.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>

    <script src="{{url('css/pembelian/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{url('css/pembelian/assets/js/main.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

</head>

<body>
    <!-- modal -->
    <div style="color: black;" class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div id="lebarmodal" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="judulmodal" class="modal-title d-inline-flex" id="exampleModalLongTitle"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodymodal" class="modal-body">

                </div>
                <div id="footermodal" class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- tambah -->
    <div style="color: black;" class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="judulmodal" class="modal-title d-inline-flex" id="exampleModalLongTitle">@yield('judulTambah')</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="bodymodal" class="modal-body">
                    @yield('bodyTambah')
                </div>
                <div id="footermodaltambah" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <h5 class="navbar-brand">SMP</h5>
                <!-- <a class="navbar-brand" href="./"><img src="{{url('css/pembelian/images/logo.png')}}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="{{url('css/pembelian/images/logo2.png')}}" alt="Logo"></a> -->
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/pembelian/"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <!-- <h3 class="menu-title">Manajemen Data</h3>/.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-database"></i>Manajemen Data</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="/pembelian/pemasoks">Data Pemasok</a></li>
                            <li><a href="/pembelian/pengirims">Data pengirim</a></li>
                            <li><a href="/stok/barangs">Data barang</a></li>
                            <li><a href="/stok/gudangs">Data gudang</a></li>
                        </ul>
                    </li>

                    @if(auth()->user()->role->role_name == 'Admin Pembelian')
                    <h3 class="menu-title">Transaksi</h3><!-- /.menu-title -->
                    <li><a href="/pembelian/permintaans"> <i class="menu-icon fa fa-envelope-open-text"></i>Permintaan Penawaran Harga</a></li>
                    <li><a href="/pembelian/pemesanans"> <i class="menu-icon fa fa-boxes"></i>Pemesanan</a></li>
                    <li><a href="/pembelian/penerimaans"> <i class="menu-icon fa fa-shipping-fast"></i>Penerimaan Barang</a></li>
                    <li><a href="/pembelian/fakturs"> <i class="menu-icon fa fa-clipboard-check"></i>Faktur</a></li>
                    @endif
                    @if(auth()->user()->role->role_name == 'Admin Retur Pembelian')
                    <h3 class="menu-title">Transaksi</h3><!-- /.menu-title -->
                    <li><a href="/pembelian/fakturs"> <i class="menu-icon fa fa-clipboard-check"></i>Faktur</a></li>
                    <li><a href="/pembelian/returs"> <i class="menu-icon fa fa-exchange-alt"></i>Retur Pembelian</a></li>
                    @endif
                    @if(auth()->user()->role->role_name == 'Admin Utang')
                    <h3 class="menu-title">Transaksi</h3><!-- /.menu-title -->
                    <li><a href="/pembelian/fakturs"> <i class="menu-icon fa fa-clipboard-check"></i>Faktur</a></li>
                    <h3 class="menu-title">Hutang</h3><!-- /.menu-title -->
                    <li><a href="/pembelian/hutang-bagi"> <i class="menu-icon fa fa-file-invoice-dollar"></i>Hutang</a></li>
                    <li><a href="/pembelian/pembayarans"> <i class="menu-icon fa fa-hand-holding-usd"></i>Pembayaran Hutang</a></li>
                    @endif
                    @if(auth()->user()->role->role_name == 'Manager Pembelian')
                    <h3 class="menu-title">Laporan & Jurnal</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Laporan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="/pembelian/permintaan/laporan">Laporan Permintaan</a></li>
                            <li><a href="/pembelian/pemesanan/laporan">Laporan Pemesanan</a></li>
                            <li><a href="/pembelian/penerimaan/laporan">Laporan Penerimaan</a></li>
                            <li><a href="/pembelian/faktur/laporan">Laporan Faktur</a></li>
                            <li><a href="/pembelian/retur/laporan">Laporan Retur</a></li>
                            <li><a href="/pembelian/pembayaran/laporan">Laporan Pembayaran</a></li>
                            <li><a href="/pembelian/hutang/laporan">Laporan Hutang</a></li>
                        </ul>
                    </li>
                    <li><a href="/pembelian/jurnals"> <i class="menu-icon fa fa-file-alt"></i>Jurnal</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <h5>Sistem Manajemen Pembelian</h5>
                        <!-- <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div> -->

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <div class="d-flex">
                            <p class="mt-2">{{auth()->user()->role->role_name}} |</p>
                            <a class="nav-link" href="/pembelian/auth/logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs d-flex justify-content-end">
            <div class="page-header float-left">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="/pembelian/">Dashboard</a></li>
                        @yield('path')
                    </ol>
                </div>
            </div>
        </div>
        @yield('alert')
        <div class="content mt-3">

            @yield('isi')

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>



</body>

</html>