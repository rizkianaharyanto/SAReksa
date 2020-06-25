@extends('kepegawaian.sidebar')

@section('content')
  <div class="row text-white">

    <div class="card bg-info ml-3" style="width: 25rem;">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-id-badge"></i>
        </div>
        <h5 class="card-title">Pegawai</h5>
        <div class="display-4">4</div>
        <a href="{{ url('kepegawaian/pegawai') }}"><p class="card-text text-white">Lihat Selengkapnya <i class="fa fa-angle-double-right ml-2"></i></p></a>
      </div>
    </div>

    <div class="card bg-success ml-3" style="width: 25rem;">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-money-bill-wave-alt"></i>
        </div>
        <h5 class="card-title">Total Gaji</h5>
        <div class="display-4">4Jt (April)</div>
        <a href="{{ url('kepegawaian/pemesanan') }}"><p class="card-text text-white">Lihat Selengkapnya <i class="fa fa-angle-double-right ml-2"></i></p></a>
      </div>
    </div>

  </div>

@endsection


