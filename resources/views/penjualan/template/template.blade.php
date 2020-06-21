<!--
=========================================================
 Paper Dashboard - v2.0.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 UPDIVISION (https://updivision.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/img/penjualan/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/penjualan/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
    <title>
        {{ __('Sistem Informasi Penjualan') }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="/css/penjualan/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/penjualan/paper-dashboard.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/penjualan/DataTables/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/penjualan/tables.css') }}" />
    <script src="{{ url('/css/penjualan/DataTables/datatables.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>


</head>

<body class=>
    
    <div class="wrapper">
        @include('penjualan.sidebar.sidebar')
        <div class="main-panel">
            @include('penjualan.sidebar.bar')
            @yield('content')
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="/js/penjualan/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="/js/penjualan/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/penjualan/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>    
    
    @stack('scripts')

</body>

</html>
