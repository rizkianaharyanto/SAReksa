<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Session::get('title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/sidebar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/app.css') }}" />


    <script type="text/javascript" src="assets/DataTables/media/js/jquery.js"></script>

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/DataTables/datatables.min.css') }}" />
    <script src="{{ url('/css/kepegawaian/DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/DataTables/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/pembelian/tables.css') }}" />
    <script src="{{ url('/css/pembelian/DataTables/datatables.min.js') }}"></script>
  
    
</head>

<body class="background">
    @section('sidebar')
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>HR MANAGER </h3>
                <strong></strong>
            </div>
            <ul class="list-unstyled components">
                
                <p> </p>
                
                <li>
                    <h5>. {{ Session::get('nama') }}</h5>
                </li>
                @if((Session::get('page'))=="dashboard")
                    <li  class="active">
                        <a href="{{ url('/kepegawaian/') }}">Dashboard</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/') }}">Dashboard</a>
                    </li>
                @endif

                @if((Session::get('page'))=="admin")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/admin') }}">Admin</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/admin') }}">admin</a>
                    </li>
                @endif

                @if((Session::get('page'))=="pengguna")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/pengguna') }}">pengguna</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/pengguna') }}">pengguna</a>
                    </li>
                @endif

                @if((Session::get('page'))=="jabatan")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/jabatan') }}">jabatan</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/jabatan') }}">jabatan</a>
                    </li>
                @endif

                @if((Session::get('page'))=="pegawai")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/pegawai') }}">pegawai</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/pegawai') }}">pegawai</a>
                    </li>
                @endif

                @if((Session::get('page'))=="penggajian")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/penggajian') }}">penggajian</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/penggajian') }}">penggajian</a>
                    </li>
                @endif

                @if((Session::get('page'))=="laporan")
                    <li class="active">
                        <a href="{{ url('/kepegawaian/laporan') }}">laporan</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/kepegawaian/laporan') }}">laporan</a>
                    </li>
                @endif

                
                <li class="logout">
                    <span>
                        <a href="/kepegawaian/logout"> Logout</a>
                    </span>
                    <span>
                        <img src="{{ asset('/img/kepegawaian/logout.svg') }}" alt="">

                    </span>
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