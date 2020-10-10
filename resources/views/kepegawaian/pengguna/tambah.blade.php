@extends('kepegawaian.sidebar')

@section('content')
 
<div class="col-5 mt-4">
  <form action="store" method="POST">
  @csrf

  <div class="form-group row">
  <label for="name" class="col-4 col-form-label">Nama Lengkap</label>
  <div class="col-8">
      <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name">
  </div>
  </div>

  <div class="form-group row">
  <label for="email" class="col-4 col-form-label">Email</label>
  <div class="col-8">
      <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email">
  </div>
  </div>

  <div class="form-group row">
  <label for="userable_id" class="col-4 col-form-label">Username</label>
  <div class="col-8">
      <input class="form-control @error('userable_id') is-invalid @enderror" type="text" id="userable_id" name="userable_id">
  </div>
  </div>



  <div class="form-group row">
    <label for="userable_type" class="col-4 col-form-label">Tipe Pengguna</label>
    <div class="col-8">
      <select class="form-control" id="userable_type" name="userable_type">
          <!-- <option value="akuntansi/admin">akuntansi/admin</option>
          <option value="akuntansi/akuntan">akuntansi/akuntan</option>
          <option value="akuntansi/keuangan">akuntansi/keuangan</option> -->
          <option value="kepegawaian/admin">kepegawaian/admin</option>
          <!-- <option value="kepegawaian/recruitment">kepegawaian/recruitment</option>
          <option value="kepegawaian/keuangan">kepegawaian/keuangan</option>
          <option value="kepegawaian/admin">Pembelian/admin</option>
          <option value="kepegawaian/produsen">Pembelian/produsen</option>
          <option value="kepegawaian/keuangan">Pembelian/keuangan</option>
          <option value="penjualan/admin">penjualan/admin</option>
          <option value="penjualan/sales">penjualan/sales</option>
          <option value="penjualan/keuangan">penjualan/keuangan</option>
          <option value="stok/admin">stok/admin</option>
          <option value="stok/gudang">stok/gudang</option>
          <option value="stok/keuangan">stok/keuangan</option> -->
      </select>
    </div>
  </div>

  <div class="form-group row">
  <label for="password" class="col-4 col-form-label">Password</label>
  <div class="col-8">
      <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password">
  </div>
  </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
  
  </form>
</div>


@endsection


