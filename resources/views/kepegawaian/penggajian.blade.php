@extends('kepegawaian.sidebar')

@section('content')

<a href="penggajian/tambah">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
      <i class="fas fa-plus-square mr-1"></i>
      Tambah
    </button>
  </a>


<a href="penggajian/tunjangan">
    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#addBarangModal">
    <i class="fas fa-receipt"></i>
      Tunjangan
    </button>
  </a>

<a href="penggajian/ditolak">
    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#addBarangModal">
    <i class="fas fa-clipboard-list"></i>
      Daftar dihapus
    </button>
  </a>


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
              <th style="alignment:justify, width:220px">Opsi</th>
          </tr>
      </thead>
      <tbody style=" background-color:white ">
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
                <b><u>Gaji yang diterima</u></b>
                
              </td>
              <td>
                @foreach( $penggajian->tunjangan as $index => $tunjangan )
                    Rp <div style="float: right; display: inline-block;">{{ number_format($tunjangan->pivot->jumlah_tunjangan) }}</div> <br>
                @endforeach
                <br>
                Rp<div style="float: right; display: inline-block;">{{ number_format($penggajian->jumlah) }}</div>
                <br>
                Rp<div style="float: right; display: inline-block;">{{ number_format($penggajian->pajak) }}</div>
                <br>
                Rp<div style="float: right; display: inline-block;"><b><u>{{ number_format($penggajian->gaji) }}</u></b></div>
              </td>
              <td>
              @if($penggajian->status == '0')
                <a href="penggajian/{{ $penggajian->id }}">
                  <button class="btn btn-success">Edit</button>
                </a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#TerimaModal{{ $penggajian->id }}">Konfirmasi</button>
                </a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#TolakModal{{ $penggajian->id }}">Hapus</button>
                </a>
              @elseif($penggajian->status == '1')
                Diterima
              @elseif($penggajian->status == '2')
                Ditolak
              @endif
              </td>
          </tr>

        <!-- Terima Modal -->
        <div class="modal fade" id="TerimaModal{{ $penggajian->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                  <div class="form-group">
                    <p>Yakin konfirmasi pengajuan penggajian yang dipilih?</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <a href="penggajian/terima/{{ $penggajian->id }}">
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">konfirmasi</button>
                  </a>
                </div>
            </div>
          </div>
        </div>

          <!-- Tolak Modal -->
          <div class="modal fade" id="TolakModal{{ $penggajian->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Peringatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <p>Yakin menghapus pengajuan penggajian yang dipilih?</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="penggajian/tolak/{{ $penggajian->id }}">
                      <button type="submit" id="submit" name="submit" class="btn btn-danger">Hapus</button>
                    </a>
                  </div>
              </div>
            </div>
          </div>

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


