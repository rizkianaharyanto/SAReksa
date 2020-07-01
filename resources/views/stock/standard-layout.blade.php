<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('css')

    <link rel="stylesheet" href="{{asset('vendor/stock/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('vendor/stock/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/stock/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/vector-map/jqvmap.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/jvectormap/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/fonts/flag-icon-css/flag-icon.min.css')}}">
    @show
    <title>Sistem Mangement Stock Reksa Karya</title>


</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            @include('stock.partials.navbar')
        </div>
        <div class="sidebar">
            @include('stock.partials.left-sidebar')
        </div>
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                @section('main-content')

                @show
            </div>
            @section('footer')

            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a
                                href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection
        </div>

    </div>

    @section('scripts')

    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <!-- bootstrap bundle js-->
    <script src="{{asset('vendor/stock/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js-->
    <script src="{{asset('vendor/stock/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- chartjs js-->
    <script src="{{asset('vendor/stock/charts/charts-bundle/Chart.bundle.js')}}"></script>
    <script src="{{asset('vendor/stock/charts/charts-bundle/chartjs.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <!-- main js-->
    <script src="{{asset('js/stock/main-js.js')}}"></script>
    <!-- jvactormap js-->
    <script src="{{asset('vendor/stock/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('vendor/stock/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- sparkline js-->
    <script src="{{asset('vendor/stock/charts/sparkline/jquery.sparkline.js')}}"></script>
    <script src="{{asset('vendor/stock/charts/sparkline/spark-js.js')}}"></script>
    <!-- dashboard sales js-->
    <script src="{{asset('js/stock/dashboard-sales.js')}}"></script>
    @show
</body>

</html>