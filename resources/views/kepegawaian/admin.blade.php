@extends('kepegawaian.sidebar')

@section('content')
   <a href="admin/pph">
    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#addBarangModal"><i class="fas fa-hand-holding-usd"></i>
      PPH 21
    </button>
  </a><br>
  <a href="admin/ptkp">
    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#addBarangModal"><i class="fas fa-funnel-dollar"></i> 
      PTKP
    </button>
  </a><br>
  <a href="admin/akun">
    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#addBarangModal"><i class="fas fa-wallet"></i>
      Akun Beban
    </button>
  </a>

@endsection


