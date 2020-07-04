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

<body>
   <div class="sidenav">
      <div class="login-main-text">
         <h2>Halaman Daftar<br> Sistem Informasi Penjualan</h2>
         <p>Daftar dari sini untuk mendapatkan akses</p>
      </div>
   </div>
   <div class="main">
      <div class="col-lg-4 col-sm-12">
         <div class="login-form">
            <form method="POST" autocomplete="off">
               @csrf
               <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name='nama' class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                     placeholder="Nama" value="{{old('nama')}}">
               </div>
               <div class="form-group">
                  <label>Email</label>
                  <input type="email" name='email' class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                     placeholder="Email" value="{{old('email')}}">
               </div>
               <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" id="role" name="role_id">
                     @foreach ($roles as $role)
                     <option value="{{$role->id}}">{{$role->role_name}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="password" name='password'
                     class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password">
               </div>
               <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password" name='password_confirmation'
                     class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                     placeholder="Konfirmasi Password">
               </div>
               <button type="submit" class="btn btn-black">Daftar</button>
               <a href="/penjualan/login">
                  <button type="button" class="btn btn-secondary">Batal</button>
               </a>
            </form>
         </div>
      </div>
   </div>
</body>

</html>