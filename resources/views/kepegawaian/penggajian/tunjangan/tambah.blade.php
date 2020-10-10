@extends('kepegawaian.sidebar')

@section('content')

<div class="col-5 mt-4">
  <form action="store" method="POST">
  @csrf



  <div class="form-group row">
      <label for="nama_tunjangan" class="col-4 col-form-label">Nama Tunjangan</label>
      <div class="col-8">
        <input class="form-control @error('nama_tunjangan') is-invalid @enderror" type="text" id="nama_tunjangan" name="nama_tunjangan">
      </div>
    </div>

    <div class="form-group row">
      <label for="akun_id" class="col-4 col-form-label">Akun Beban</label>
      <div class="col-8">
        <select class="form-control @error('akun_id') is-invalid @enderror" id="akun_id" name="akun_id">
        @foreach( $akuns as $akun )
            <option value="{{ $akun->id }}">{{ $akun->nama_akun }}</option>
        @endforeach
        </select>
      </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
  
  </form>
</div>


@endsection

