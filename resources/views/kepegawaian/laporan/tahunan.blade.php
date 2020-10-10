@extends('kepegawaian.sidebar')

@section('content')

<h2 style="text-align:center; font-weight:bold"> </h3><br>


<div>
  <table id="table_id" class="table shadow">
      <thead style="background-color: #4b4b4b; color:white;">
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Periode</th>
              <th>Jenis</th>
              <th style="width:200px">Jumlah</th>
              <th style="width:40px">Aksi</th>
          </tr>
      </thead>
      <tbody style=" background-color: white; ">
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
              {{ \Carbon\Carbon::parse($penggajian->tanggal)->format('F Y') }}
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
                <div style="width:110px">Rp <div style="float: right; display: inline-block;">{{ number_format($tunjangan->pivot->jumlah_tunjangan) }}</div> </div>
                @endforeach
                <br>
                <div style="width:110px">Rp<div style="float: right; display: inline-block;">{{ number_format($penggajian->jumlah) }}</div></div> 
                <div style="width:110px">Rp<div style="float: right; display: inline-block;">{{ number_format($penggajian->pajak) }}</div></div>
                <div style="width:110px">Rp<div style="float: right; display: inline-block;">{{ number_format($penggajian->gaji) }}</div></div>
              </td>
              <td>
                <a href="slip/{{ \Crypt::encryptString($penggajian->id) }}">cetak</a>
              </td>
          </tr>

        @endforeach
      </tbody>
  </table>
</div>


@endsection


