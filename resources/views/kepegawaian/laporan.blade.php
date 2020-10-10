@extends('kepegawaian.sidebar')

@section('content')




<div class="row mt-5">
  <div class="col-sm-3" >
    <div class="card shadow">
      <div class="card-body">
        <h5 class="card-title">Perbulan</h5>
        <form action="laporan/bulanan" method="POST">
  @csrf

  <div class="form-group row">
    <label for="bulan" class="col-sm-4 col-form-label">Bulan</label>
    <div class="col-sm-8">
      <select class="form-control @error('bulan') is-invalid @enderror" id="bulan" name="bulan">
          <option value="" selected>- Pilih Bulan -</option>
          <option value="01">Januari</option>
          <option value="02">Februari</option>
          <option value="03">Maret</option>
          <option value="04">April</option>
          <option value="05">Mei</option>
          <option value="06">Juni</option>
          <option value="07">Juli</option>
          <option value="08">Agustus</option>
          <option value="09">September</option>
          <option value="10">Oktober</option>
          <option value="11">November</option>
          <option value="12">Desember</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
      <label for="tahun" class="col-4 col-form-label">Tahun</label>
      <div class="col-8">
        <input class="form-control @error('tahun') is-invalid @enderror" type="text" id="tahun" name="tahun" value="2020">
      </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Cari</button>
  
  </form>
      </div>
    </div>
  </div>
  
</div>
<div class="row mt-5">
  <div class="col-sm-3">
    <div class="card shadow">
      <div class="card-body">
        <h5 class="card-title">Pegawai</h5>
        <form action="laporan/pegawai" method="POST">
          @csrf

          <div class="form-group row">
            <label for="pegawai" class="col-sm-4 col-form-label">Pegawai</label>
            <div class="col-sm-8">
              <select class="form-control @error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai">

              <option value="">- Pilih pegawai -</option>
                  @foreach( $pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                  @endforeach
              </select>
            </div>
          </div>


            <button type="submit" id="submit" name="submit" class="btn btn-primary">Cari</button>
          
          </form>
      </div>
    </div>
  </div>
</div>

@endsection


