<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="{{url('css/pembelian/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('css/pembelian/vendors/selectFX/css/cs-skin-elastic.css')}}">


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

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body style="background-color: #108d7c">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                
                    <h1 style="color: white">Login</h1>
                    <!-- <a href="index.html"> -->
                        <!-- <img class="align-content" src="images/logo.png" alt=""> -->
                    <!-- </a> -->
                </div>
                <div class="login-form">
                    <form method="POST" action="/pembelian/auth/login">
                    @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                                <!-- <div class="checkbox">
                                    <label>
                                <input type="checkbox"> Remember Me
                            </label>
                                    <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                                </div> -->
                                <button type="submit" class="btn btn-flat m-b-30 m-t-30" style="background-color: #108d7c; color:white">Login</button>
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                        <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                                    </div>
                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                                </div> -->
                    </form>
                </div>
                @if (session('message'))
            <div class="mt-3 alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
            </div>
        </div>
    </div>


    <script src="{{url('css/pembelian/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('css/pembelian/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{url('css/pembelian/assets/js/main.js')}}"></script>


</body>

</html>
