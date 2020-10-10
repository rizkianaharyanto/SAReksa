<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem informasi kepegawaian dan penggajian pegawai</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/login.css') }}" />

    </head>
    <body>
        <div class="luar flex-center position-ref full-height">
            <div class="content">
                <div class="coll" style="width:50%">
                    <div class="to-img">
                        <img class="img" src="{{ url('/img/kepegawaian/3350449.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-kanan">
                    <div class="form">
                        <form action="logincheck" method="POST">
                        @csrf
                            <span>
                                <!-- <h1><i class="fas fa-user"></i></h1> -->
                                
                            <h3>Sistem Informasi Kepegawaian dan Penggajian Pegawai</h3>
                                <h3>Login</h3>

                            </span>
                            <span>
                                <div class="input">
                                <input class="input100 form-control" type="text" name="username" placeholder="username" required>
                                </div>
                            </span>
                            <span>
                                <div class="input">
                                <input class="input100 form-control" type="password" name="password" placeholder="Password" required>
                                </div>
                            </span>
                            @if (session('status'))
                            <span>
                                <div class="alert alert-danger">
                                    {{ session('status')  }}
                                </div>
                            </span>
                            @endif
                            <span>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Masuk</button>
                            </span>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
