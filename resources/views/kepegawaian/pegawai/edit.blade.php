@extends('kepegawaian.sidebar')

@section('content')

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status')  }}
    </div>
  @endif
<div class="col-4 mt-4">
  <form action="{{ $pegawai->id }}" method="POST">
  @method('PUT')
  @csrf

    <div class="form-group row">
      <label for="nama" class="col-4 col-form-label">Nama</label>
      <div class="col-8">
        <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ $pegawai->nama }}">
      </div>
    </div>

    <!-- <div class="form-group row">
      <label for="kode_pegawai" class="col-4 col-form-label">Kode pegawai</label>
      <div class="col-8">
        <input class="form-control @error('kode_pegawai') is-invalid @enderror" type="text" id="kode_pegawai" name="kode_pegawai" value="{{ $pegawai->kode_pegawai }}">
      </div>
    </div> -->

    <div class="form-group row">
      <label for="KTP" class="col-4 col-form-label">KTP</label>
      <div class="col-8">
        <input class="form-control @error('ktp') is-invalid @enderror" type="text" id="KTP" name="ktp" value="{{ $pegawai->ktp }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="Email" class="col-4 col-form-label">Email</label>
      <div class="col-8">
        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ $pegawai->email }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="handphone" class="col-4 col-form-label">No HP</label>
      <div class="col-8">
        <input class="form-control @error('handphone') is-invalid @enderror" type="text" id="handphone" name="handphone" value="{{ $pegawai->handphone }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="masuk" class="col-4 col-form-label">Tanggal Masuk</label>
      <div class="col-8">
        <input class="form-control @error('masuk') is-invalid @enderror" type="date" id="masuk" name="masuk" value="{{ $pegawai->masuk }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="catatan" class="col-4 col-form-label">catatan</label>
      <div class="col-8">
        <input class="form-control @error('catatan') is-invalid @enderror" type="text" id="catatan" name="catatan" value="{{ $pegawai->catatan }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="alamat" class="col-4 col-form-label">alamat</label>
      <div class="col-8">
        <input class="form-control @error('alamat') is-invalid @enderror" type="text" id="alamat" name="alamat" value="{{ $pegawai->alamat }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="kode_pos" class="col-4 col-form-label">kode_pos</label>
      <div class="col-3">
        <input class="form-control @error('kode_pos') is-invalid @enderror" type="number" id="kode_pos" name="kode_pos" value="{{ $pegawai->kode_pos }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="npwp" class="col-4 col-form-label">NPWP</label>
      <div class="col-8">
        <input class="form-control @error('npwp') is-invalid @enderror" type="text" id="npwp" name="npwp" value="{{ $pegawai->npwp }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="jabatan" class="col-4 col-form-label">PTKP</label>
      <div class="col-8">
        <select class="form-control" id="exampleSelect4" name="ptkp">
        @foreach( $ptkps as $ptkp )
            <option value="{{ $ptkp->id }}">{{ $ptkp->status_ptkp }} | {{ $ptkp->keterangan }}</option>
        @endforeach
        </select>
      </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Ubah</button>
  
  </form>
</div>


@endsection


