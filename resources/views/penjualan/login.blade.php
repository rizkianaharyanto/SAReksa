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
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/penjualan/login.css') }}" />

    </head>

    <body >
    <div class="sidenav">
         <div class="login-main-text">
            <h2>Halaman Login<br> Sistem Informasi Penjualan</h2>
            <p>Login dari sini untuk mendapatkan akses</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
               <form method="POST" autocomplete="off">
               @csrf
                  <div class="form-group">
                     <label>Email</label>
                     <input required name="email" type="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input required name="password" type="password" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
                  <a href="/penjualan/register">
                  <button type="button" class="btn btn-secondary">Register</button>
                  </a>
               </form>
            </div>
         </div>
      </div>
      <script src="/js/penjualan/plugins/bootstrap-notify.js"></script>

      <script>

    var message = '{{ Session::get('message')}}';
    if(message){
      $(document).ready(function() {
        console.log(message)
        $.notify({
        icon: "fa fa-times",
        type: 'success',
        message: message
      },{
          timer: 50,
          placement: {
              from: 'top',
              align: 'right'
          },
          template: '<div class="alert alert-danger alert-with-icon alert-dismissible fade show" data-notify="container">' +
                    '<span data-notify="icon" class="{0}"></span>'+
                    '<span data-notify="message">{2}</span>'+
                  '</div>'
        });
      });
      
    }  
    </script>
</body>

</html>
