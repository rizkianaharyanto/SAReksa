<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Session::get('title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ url('/css/kepegawaian/bootstrap.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/sidebar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/app.css') }}" />


    <!-- <script type="text/javascript" src="assets/DataTables/media/js/jquery.js"></script> -->




    <!-- datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/DataTables/datatables.min.css') }}" />
    <script src="{{ url('/css/kepegawaian/DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/DataTables/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/tables.css') }}" />
    <script src="{{ url('/css/pembelian/DataTables/datatables.min.js') }}"></script> -->

    <!-- <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/datatables/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/datatables/buttons.bootstap4.min.css') }}" />
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="{{ url('/css/kepegawaian/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('/css/kepegawaian/datatables/datatables.min.js') }}"></script>
    
</head>

<body class="background">
    @section('sidebar')
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3> Admin </h3>
                <strong></strong>
            </div>
            <ul class="list-unstyled components">
                
                <p> </p>
                
                <li>
                    <h5>. <i class="fas fa-id-badge"></i> {{ Session::get('nama') }}</h5>
                </li>
                    <li class="{{Session::get('page')=='dashboard'?'active':''}}">
                        <a href="{{ url('/kepegawaian/') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>

                    <li class="{{Session::get('page')=='admin'?'active':''}}">
                        <a href="{{ url('/kepegawaian/admin') }}"><i class="fas fa-user-cog"></i> Admin</a>
                        <ul class=" list-unstyled" id="homeSubmenu">
                            <li  class="{{Session::get('page')=='pph'?'active':''}}">
                                <a href="{{ url('/kepegawaian/admin/pph') }}"><i class="fas fa-hand-holding-usd"></i> PPh 21</a>
                            </li>
                            <li  class="{{Session::get('page')=='ptkp'?'active':''}}">
                                <a href="{{ url('/kepegawaian/admin/ptkp') }}"><i class="fas fa-funnel-dollar"></i> PTKP</a>
                            </li>
                            <li  class="{{Session::get('page')=='akun'?'active':''}}">
                                <a href="{{ url('/kepegawaian/admin/akun') }}"><i class="fas fa-wallet"></i> Akun Beban</a>
                            </li>
                        </ul>
                    </li>

                    <li  class="{{Session::get('page')=='pengguna'?'active':''}}">
                        <a href="{{ url('/kepegawaian/pengguna') }}"><i class="fas fa-users-cog"></i> pengguna</a>
                    </li>

                    <li  class="{{Session::get('page')=='jabatan'?'active':''}}">
                        <a href="{{ url('/kepegawaian/jabatan') }}"><i class="fas fa-id-badge"></i> jabatan</a>
                        <ul class=" list-unstyled" id="homeSubmenu">
                            <li  class="{{Session::get('page')=='promosi'?'active':''}}">
                                <a href="{{ url('/kepegawaian/jabatan/promosi') }}"><i class="fas fa-angle-double-up"></i> Sejarah Jabatan</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{Session::get('page')=='pegawai'?'active':''}}">
                        <a href="{{ url('/kepegawaian/pegawai') }}"><i class="fas fa-user-tie"></i> pegawai</a>
                    </li>

                    <li class="{{Session::get('page')=='penggajian'?'active':''}}">
                        <a href="{{ url('/kepegawaian/penggajian') }}"><i class="fas fa-file-invoice-dollar"></i> penggajian</a>
                        <ul class=" list-unstyled" id="homeSubmenu">
                            <li class="{{Session::get('page')=='tunjangan'?'active':''}}">
                                <a href="{{ url('/kepegawaian/penggajian/tunjangan') }}"><i class="fas fa-receipt"></i> Daftar Tunjangan</a>
                            </li>
                            <li class="{{Session::get('page')=='dihapus'?'active':''}}">
                                <a href="{{ url('/kepegawaian/penggajian/ditolak') }}"><i class="fas fa-clipboard-list"></i> Daftar Dihapus</a>
                            </li>
                        </ul>
                    </li>

                @if((Session::get('page'))=="laporan")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/laporan') }}"><i class="fas fa-file-invoice"></i> laporan</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/laporan') }}"><i class="fas fa-file-invoice"></i> laporan</a>
                    </li>
                @endif

                
                <li class="logout">
                        <a href="/kepegawaian/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>

            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div id="toggler" class="container-fluid">
                    <div style="display:flex">
                            <button type="button" id="sidebarCollapse" class="btn btn-info">
                                <i class="fas fa-bars"></i>
                                <span></span>
                            </button>
                    </div>
                </div>

            </nav>

            <div style="width:100%;">
            </div>
        </div>

        <div class="col-md-10 p5 pt-2">
            <!-- <div> -->
 
            <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/dashboard.css') }}" />
            <h1 class="title"><i class="fas fa-tachometer-alt mr-2 pt-2"></i>{{ Session::get('title') }}</h1><hr>
                @yield('content')
            <!-- </div> -->
        </div>

    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->


<link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/datatables/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/datatables/buttons.bootstap4.min.css') }}" />
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="{{ url('/css/kepegawaian/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('/css/kepegawaian/datatables/datatables.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            // $('#sidebar').hide();

            $('#sidebarCollapse').on('click', function() {
                
                $('#sidebar').toggleClass('active');
            });

        });
    </script>


</body>

</html>