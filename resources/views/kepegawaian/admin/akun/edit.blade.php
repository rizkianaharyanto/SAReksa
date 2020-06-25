@extends('kepegawaian.sidebar')

@section('content')
 
<div>
  <form action="{{ $akun->id }}" method="POST">

  @method('PUT')
  @csrf

  <div class="form-group row">
  <label for="nama_akun" class="col-2 col-form-label">Nama Akun</label>
  <div class="col-10">
      <input class="form-control @error('nama_akun') is-invalid @enderror" type="text" id="nama_akun" name="nama_akun" value="{{ $akun->nama_akun }}">
  </div>
  </div>

  <div class="form-group row">
  <label for="keterangan" class="col-2 col-form-label">keterangan</label>
  <div class="col-10">
      <input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan" name="keterangan" value="{{ $akun->keterangan }}">
  </div>
  </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
  
  </form>
</div>


@endsection


