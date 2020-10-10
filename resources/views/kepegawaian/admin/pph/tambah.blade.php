@extends('kepegawaian.sidebar')

@section('content')
 
<div class="col-4 mt-5">
  <form action="store" method="POST">
  @csrf

  <div class="form-group row">
  <label for="batas_minimal" class="col-4 col-form-label">Minimal</label>
  <div class="col-8">
      <input class="form-control @error('batas_minimal') is-invalid @enderror" type="number" id="batas_minimal" name="batas_minimal">
  </div>
  </div>

  <div class="form-group row">
  <label for="batas_maksimal" class="col-4 col-form-label">Maksimal</label>
  <div class="col-8">
      <input class="form-control @error('batas_maksimal') is-invalid @enderror" type="number" id="batas_maksimal" name="batas_maksimal">
  </div>
  </div>

  <div class="form-group row">
  <label for="persentase" class="col-4 col-form-label">Persentase Pajak</label>
  <div class="col-8">
      <input class="form-control @error('persentase') is-invalid @enderror" type="number" id="persentase" name="persentase">
  </div>
  </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
  
  </form>
</div>


@endsection


