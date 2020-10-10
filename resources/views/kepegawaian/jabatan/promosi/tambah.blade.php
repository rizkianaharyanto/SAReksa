@extends('kepegawaian.sidebar')

@section('content')

<div class="col-5 mt-4">
  <form action="store" method="POST">
  @csrf


  <div class="form-group row">
      <label for="pegawai_id" class="col-4 col-form-label">Pegawai</label>
      <div class="col-8">
        <select class="form-control @error('jabatan_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id">
        @foreach( $pegawais as $pegawai )
            <option value="{{ $pegawai->id }}"> {{ $pegawai->nama }} |
                @php
                  $count = count($pegawai->jabatans);
                @endphp
                @foreach( $pegawai->jabatans as $indexKey => $jbt )
                  @if( $count-1 == $indexKey )
                    {{ $jbt->nama_jabatan }} 
                  @endif
                @endforeach</option>
        @endforeach
        </select>
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

    <div class="form-group row">
    <label for="tanggal" class="col-4 col-form-label">Tanggal</label>
    <div class="col-8">
        <input class="form-control @error('tanggal') is-invalid @enderror" type="date" id="tanggal" name="tanggal">
    </div>
    </div>

    <div class="form-group row">
    <label for="keterangan" class="col-4 col-form-label">Keterangan</label>
    <div class="col-8">
        <input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan" name="keterangan">
    </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Ubah</button>
  
  </form>
</div>


@endsection

