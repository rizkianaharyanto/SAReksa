@extends('kepegawaian.sidebar')

@section('content')
   <a href="admin/pph">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
      <i class="fas fa-plus-square mr-1"></i>
      PPH 21
    </button>
  </a>
  <a href="admin/ptkp">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
      <i class="fas fa-plus-square mr-1"></i>
      PTKP
    </button>
  </a>
  <a href="admin/akun">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
      <i class="fas fa-plus-square mr-1"></i>
      Akun Beban
    </button>
  </a>
  

  </div>

@endsection


