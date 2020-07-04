<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('vendor/stock/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('vendor/stock/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/stock/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/fonts/fontawesome/css/fontawesome-all.css')}}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>

    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
        @endif
        <div class="card ">
            <div class="card-header text-center"><a href="../index.html">
                    <h1 style="color: #349eac; font-weight: bold">Login</h1>
                </a><span class="splash-description">Please
                    enter
                    your user information.</span></div>
            <div class="card-body">
                <form method="POST" action="/stok/auth/login">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control form-control-lg" id="email" name="email" type="email"
                            placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>

                        <input class="form-control form-control-lg" name="password" id="password" type="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span
                                class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" style="background-color:#349eac" class="btn btn-primary btn-lg btn-block"
                        style="">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{asset('vendor/stock/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('vendor/stock/bootstrap/js/bootstrap.bundle.js')}}"></script>
</body>

</html>