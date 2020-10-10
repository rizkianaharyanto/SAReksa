@extends('kepegawaian.sidebar')

@section('content')
 

<div class="col-4 mt-4">
  <form action="store" method="POST">
  @csrf

    <div class="form-group row">
    <label for="status_ptkp" class="col-4 col-form-label">Jenis</label>
    <div class="col-4">
        <input class="form-control @error('status_ptkp') is-invalid @enderror" type="text" id="status_ptkp" name="status_ptkp">
    </div>
    </div>

    <div class="form-group row">
    <label for="keterangan" class="col-4 col-form-label">Keterangan</label>
    <div class="col-8">
        <input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan" name="keterangan">
    </div>
    </div>

    <div class="form-group row">
    <label for="gaji_minimal" class="col-4 col-form-label">Tarif</label>
    <div class="col-8">
        <input class="form-control @error('gaji_minimal') is-invalid @enderror" type="number" id="gaji_minimal" name="gaji_minimal">
    </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
  
  </form>
</div>


@endsection


