@extends('kepegawaian.sidebar')

@section('content')
  <div class="row text-white">

    <div class="card bg-danger ml-3 shadow" style="width: 25rem;">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-money-bill-wave-alt"></i>
        </div>
        <h5 class="card-title">Jumlah Jabatan</h5>
        @php
          $countjabatan = count($jabatans);
        @endphp
        <div class="display-4">{{ $countjabatan }}</div>
        <a href="{{ url('kepegawaian/jabatan') }}"><p class="card-text text-white">Lihat Selengkapnya <i class="fa fa-angle-double-right ml-2"></i></p></a>
      </div>
    </div>

    <div class="card bg-info ml-3 shadow" style="width: 25rem;">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-id-badge"></i>
        </div>

        @php
          $countpegawai = count($pegawais);
        @endphp

        <h5 class="card-title">Jumlah Pegawai</h5>
        <div class="display-4">{{ $countpegawai }}</div>

        <a href="{{ url('kepegawaian/pegawai') }}"><p class="card-text text-white">Lihat Selengkapnya <i class="fa fa-angle-double-right ml-2"></i></p></a>
      </div>
    </div>

    <div class="card bg-success ml-3 shadow" style="width: 25rem;">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-money-bill-wave-alt"></i>
        </div>
        <h5 class="card-title">Total Pengeluaran bulan ini</h5>
        <div class="display-4">Rp {{ number_format($total) }} {{ $satuan }}</div>
        <a href="{{ url('kepegawaian/laporan/periode') }}"><p class="card-text text-white">Lihat Selengkapnya <i class="fa fa-angle-double-right ml-2"></i></p></a>
      </div>
    </div>

  </div>

@endsection


