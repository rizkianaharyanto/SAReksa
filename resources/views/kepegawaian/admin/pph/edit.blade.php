@extends('kepegawaian.sidebar')

@section('content')

  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status')  }}
    </div>
  @endif

<div class="col-4 mt-5">
  <form action="{{ $pph->id }}" method="POST">
  @method('PUT')
  @csrf

    <div class="form-group row">
    <label for="batas_minimal" class="col-4 col-form-label">Minimal</label>
    <div class="col-8">
        <input class="form-control @error('batas_minimal') is-invalid @enderror" type="number" id="batas_minimal" name="batas_minimal" value="{{ $pph->batas_minimal }}">
    </div>
    </div>

    <div class="form-group row">
    <label for="batas_maksimal @error('batas_maksimal') is-invalid @enderror" class="col-4 col-form-label">Maksimal</label>
    <div class="col-8">
        <input class="form-control" type="number" id="batas_maksimal" name="batas_maksimal" value="{{ $pph->batas_maksimal }}">
    </div>
    </div>

    <div class="form-group row">
    <label for="persentase" class="col-4 col-form-label">Persentase Pajak</label>
    <div class="col-8">
        <input class="form-control @error('persentase') is-invalid @enderror" type="number" id="persentase" name="persentase" value="{{ $pph->persentase }}">
    </div>
    </div>

    <button type="submit" id="submit" name="submit" class="btn btn-primary">Edit</button>
  
  </form>
</div>


@endsection


