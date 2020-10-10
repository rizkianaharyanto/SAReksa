@extends('kepegawaian.sidebar')

@section('content')

<div class="col-5 mt-4">
  <form action="edit/{{ $penggajian->id }}" method="POST">
  @method('PUT')
  @csrf

    <div class="form-group row">
    <label for="pegawai_id" class="col-3 col-form-label">Pegawai</label>
    <div class="col-9">
        <select class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id">
        @foreach( $pegawais as $pegawai )

            @if( $pegawai->id == $penggajian->pegawai_id)

            <option value="{{ $pegawai->id }}" selected>{{ $pegawai->kode_pegawai }} | {{ $pegawai->nama }} |
                @php
                  $count = count($pegawai->jabatans);
                @endphp
                @foreach( $pegawai->jabatans as $indexKey => $jbt )
                  @if( $count-1 == $indexKey )
                    {{ $jbt->nama_jabatan }} 
                  @endif
                @endforeach</option>

            @else


            <option value="{{ $pegawai->id }}">{{ $pegawai->kode_pegawai }} | {{ $pegawai->nama }} |
                @php
                  $count = count($pegawai->jabatans);
                @endphp
                @foreach( $pegawai->jabatans as $indexKey => $jbt )
                  @if( $count-1 == $indexKey )
                    {{ $jbt->nama_jabatan }} 
                  @endif
                @endforeach</option>

            @endif
        @endforeach
        </select>
    </div>
    </div>


    <div class="form-group row">
    <label for="tanggal" class="col-3 col-form-label">Tanggal</label>
    <div class="col-9">
        <input class="form-control @error('tanggal') is-invalid @enderror" type="date" id="tanggal" name="tanggal" value="{{ $penggajian->tanggal }}">
    </div>
    </div>


    @foreach( $penggajian->tunjangan as $indexKey => $tunjangan )

        <div id="formgaji">
        <div id="isiformgaji0">

            <div class="form-group row">
            <label for="tunjangan_id" class="col-3 col-form-label">Tunjangan</label>
            <div class="col-9">
                <select class="form-control @error('tunjangan_id') is-invalid @enderror" id="tunjangan_id" name="tunjangan_id[]">
                @foreach( $tunjangans as $tjg )
                    @if( $tjg->nama_tunjangan == $tunjangan->nama_tunjangan)
                        <option value="{{ $tjg->id }}" selected>{{ $tjg->nama_tunjangan }}</option>
                    @else
                        <option value="{{ $tjg->id }}">{{ $tjg->nama_tunjangan }}</option>
                    @endif
                @endforeach
                </select>
            </div>
            </div>

            <div class="form-group row">
            <label for="jumlah_tunjangan" class="col-3 col-form-label">jumlah</label>
            <div class="col-9">
                <input class="form-control @error('jumlah_tunjangan') is-invalid @enderror" type="text" id="jumlah_tunjangan" name="jumlah_tunjangan[]" value="{{ $tunjangan->pivot->jumlah_tunjangan }}">
            </div>
            </div>

        </div>
        </div>
    @endforeach


    <div id="tambahgaji"  style="display: inline-block;">
      <span class="btn btn-success">Tambah Tunjangan</span>
    </div>
    <div style="display: inline-block;">
      <button id="submit" type="submit" name="submit" class="btn btn-primary">Ajukan</button>
    </div>
  
  </form>
</div>

<script>
  $('#tambahgaji').click(function(){
    var i = 0;
    console.log(i);
    $('#formgaji').append($('#isiformgaji'+i).clone().attr('id','isiformgaji' + (i+1)));

  });

  function jumlah(x) {

  }
</script>


@endsection

