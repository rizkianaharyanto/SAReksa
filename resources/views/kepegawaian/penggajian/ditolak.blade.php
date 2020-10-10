@extends('kepegawaian.sidebar')

@section('content')


@if (session('status'))
  <div class="alert alert-success">
    {{ session('status')  }}
  </div>
@endif

<div>
  <table id="table_id" class="table table-hover shadow">
      <thead style="background-color: #4b4b4b; color:white;">
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Jenis</th>
              <th style="witdh:100px">Jumlah</th>
          </tr>
      </thead>
      <tbody style="background-color: white ">
        @foreach($penggajians as $indexKey => $penggajian)

          <tr>
              <td>{{ $indexKey+1 }}</td>
              <td>{{ $penggajian->pegawai->nama }}</td>
              <td>
                @php
                  $count = count($penggajian->pegawai->jabatans);
                @endphp
                @foreach( $penggajian->pegawai->jabatans as $index => $jbt )
                    
                  @if( $count-1 == $index )
                    {{ $jbt->nama_jabatan }} <br>
                  @endif
                @endforeach
              </td>
              <td>
                @foreach( $penggajian->tunjangan as $index => $tunjangan )
                    {{ $tunjangan->nama_tunjangan }} <br>
                @endforeach
                <br>
                Total Gaji
                <br>
                Pajak
                <br>
                Gaji - Pajak
              </td>
              <td>
                @foreach( $penggajian->tunjangan as $index => $tunjangan )
                    Rp <div style="float: right; display: inline-block;">{{ $tunjangan->pivot->jumlah_tunjangan }}</div> <br>
                @endforeach
                <br>
                Rp<div style="float: right; display: inline-block;">{{ $penggajian->jumlah }}</div>
                <br>
                Rp<div style="float: right; display: inline-block;">{{ $penggajian->pajak }}</div>
                <br>
                Rp<div style="float: right; display: inline-block;">{{ $penggajian->gaji }}</div>
              </td>
          </tr>

        @endforeach
      </tbody>
  </table>
</div>


<script>
  $(document).ready(function() {
    $('#table_id').DataTable({
      "scrollY": "60vh",
      "scrollCollapse": true,
    });
    $('.dataTables_length').addClass('bs-select');
  });

  
</script>
 
@endsection


