@extends('kepegawaian.sidebar')

@section('content')

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status')  }}
    </div>
  @endif
<div class="col-4 mt-4">
  <form action="add" method="POST">
  @csrf

    <div class="form-group row">
      <label for="nama" class="col-4 col-form-label">Nama</label>
      <div class="col-8">
        <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama">
      </div>
    </div>

    <div class="form-group row">
      <label for="jabatan_id" class="col-4 col-form-label">Jabatan</label>
      <div class="col-8">
        <select class="form-control @error('jabatan_id') is-invalid @enderror" id="jabatan_id" name="jabatan_id">
        @foreach( $jabatans as $jabatan )
            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
        @endforeach
        </select>
      </div>
    </div>

    <!-- <div class="form-group row">
      <label for="kode_pegawai" class="col-2 col-form-label">Kode pegawai</label>
      <div class="col-10"> -->
        <input class="form-control @error('kode_pegawai') is-invalid @enderror" type="text" id="kode_pegawai" name="kode_pegawai" value="kode" hidden>
      <!-- </div>
    </div> -->

    <div class="form-group row">
      <label for="KTP" class="col-4 col-form-label">KTP</label>
      <div class="col-8">
        <input class="form-control @error('ktp') is-invalid @enderror" type="text" id="KTP" name="ktp">
      </div>
    </div>

    <div class="form-group row">
      <label for="Email" class="col-4 col-form-label">Email</label>
      <div class="col-8">
        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email">
      </div>
    </div>

    <div class="form-group row">
      <label for="handphone" class="col-4 col-form-label">No HP</label>
      <div class="col-8">
        <input class="form-control @error('handphone') is-invalid @enderror" type="text" id="handphone" name="handphone">
      </div>
    </div>

    <div class="form-group row">
      <label for="masuk" class="col-4 col-form-label">Tanggal Masuk</label>
      <div class="col-8">
        <input class="form-control @error('masuk') is-invalid @enderror" type="date" id="masuk" name="masuk">
      </div>
    </div>

    <div class="form-group row">
      <label for="catatan" class="col-4 col-form-label">catatan</label>
      <div class="col-8">
        <input class="form-control @error('catatan') is-invalid @enderror" type="text" id="catatan" name="catatan">
      </div>
    </div>

    <div class="form-group row">
      <label for="alamat" class="col-4 col-form-label">alamat</label>
      <div class="col-8">
        <input class="form-control @error('alamat') is-invalid @enderror" type="text" id="alamat" name="alamat">
      </div>
    </div>

    <div class="form-group row">
      <label for="kode_pos" class="col-4 col-form-label">kode_pos</label>
      <div class="col-4">
        <input class="form-control @error('kode_pos') is-invalid @enderror" type="number" id="kode_pos" name="kode_pos">
      </div>
    </div>

    <div class="form-group row">
      <label for="npwp" class="col-4 col-form-label">NPWP</label>
      <div class="col-8">
        <input class="form-control @error('npwp') is-invalid @enderror" type="text" id="npwp" name="npwp">
      </div>
    </div>

    <div class="form-group row">
      <label for="jabatan" class="col-4 col-form-label">PTKP</label>
      <div class="col-8">
        <select class="form-control" id="exampleSelect2" name="ptkp">
        @foreach( $ptkps as $ptkp )
            <option value="{{ $ptkp->id }}">{{ $ptkp->status_ptkp }} | {{ $ptkp->keterangan }}</option>
        @endforeach
        </select>
      </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
  
  </form>
</div>


@endsection


