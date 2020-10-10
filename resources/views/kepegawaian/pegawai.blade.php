@extends('kepegawaian.sidebar')

@section('content')
   <a href="pegawai/tambah">
    <button type="button" class="btn btn-primary mb-3">
      <i class="fas fa-plus-square mr-1"></i>
      Tambah Pegawai
    </button>
  </a>

@if (session('status'))
  <div class="alert alert-success">
    {{ session('status')  }}
  </div>
@endif

<div>
  <table id="table_id" class="table shadow">
      <thead style="background-color: #4b4b4b; color:white;">
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th style="alignment:justify, width:200px">Aksi</th>
          </tr>
      </thead>
      <tbody style="background-color:white">
        @foreach($pegawais as $index => $pgw)

          <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $pgw->nama }}</td>
              <td>
                @php
                  $count = count($pgw->jabatans);
                @endphp
                @foreach( $pgw->jabatans as $indexKey => $jbt )
                  @if( $count-1 == $indexKey )
                    {{ $jbt->nama_jabatan }} <br>
                  @endif
                @endforeach
              </td>
              <td>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#DetailModal{{ $pgw->id }}">Detail</button>
                <a href="pegawai/{{$pgw->id}}">
                  <button class="btn btn-success">Ubah</button>
                </a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#HapusModal{{ $pgw->id }}">Hapus</button>
              </td>
          </tr>

          <!-- Detail Modal -->
          <div class="modal fade" id="DetailModal{{ $pgw->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="modal-body">
                    <div class="form-group row">
                      <label for="nama" class="col-2 col-form-label">Nama</label>
                      <div class="col-10">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ $pgw->nama }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="jabatan_id" class="col-2 col-form-label">Jabatan</label>
                      <div class="col-10">
                          @php
                            $count = count($pgw->jabatans);
                          @endphp
                          @foreach( $pgw->jabatans as $indexKey => $jbt )
                            @if( $count-1 == $indexKey )
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama" value="{{ $jbt->nama_jabatan }}" disabled>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="KTP" class="col-2 col-form-label">KTP</label>
                      <div class="col-10">
                        <input class="form-control @error('ktp') is-invalid @enderror" type="text" id="KTP" name="ktp" value="{{ $pgw->ktp }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="Email" class="col-2 col-form-label">Email</label>
                      <div class="col-10">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ $pgw->email }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="handphone" class="col-2 col-form-label">No HP</label>
                      <div class="col-10">
                        <input class="form-control @error('handphone') is-invalid @enderror" type="text" id="handphone" name="handphone" value="{{ $pgw->handphone }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="masuk" class="col-2 col-form-label">Tanggal Masuk</label>
                      <div class="col-10">
                        <input class="form-control @error('masuk') is-invalid @enderror" type="date" id="masuk" name="masuk" value="{{ $pgw->masuk }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="catatan" class="col-2 col-form-label">catatan</label>
                      <div class="col-10">
                        <input class="form-control @error('catatan') is-invalid @enderror" type="text" id="catatan" name="catatan" value="{{ $pgw->catatan }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="alamat" class="col-2 col-form-label">alamat</label>
                      <div class="col-10">
                        <input class="form-control @error('alamat') is-invalid @enderror" type="text" id="alamat" name="alamat" value="{{ $pgw->alamat }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="kode_pos" class="col-2 col-form-label">Kode Pos</label>
                      <div class="col-10">
                        <input class="form-control @error('kode_pos') is-invalid @enderror" type="number" id="kode_pos" name="kode_pos" value="{{ $pgw->kode_pos }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="npwp" class="col-2 col-form-label">NPWP</label>
                      <div class="col-10">
                        <input class="form-control @error('npwp') is-invalid @enderror" type="text" id="npwp" name="npwp" value="{{ $pgw->npwp }}" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="ptkp" class="col-2 col-form-label">PTKP</label>
                      <div class="col-10">
                        @foreach( $ptkps as $ptkp)
                          @if( $pgw->ptkp == $ptkp->id )
                            <input class="form-control @error('ptkp') is-invalid @enderror" type="text" id="ptkp" name="ptkp" value="{{ $ptkp->status_ptkp }}" disabled>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
              </div>
            </div>
          </div>



          <!-- Hapus Modal -->
          <div class="modal fade" id="HapusModal{{ $pgw->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                      <p>Yakin hapus data pegawai yang dipilih?</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="pegawai/hapus/{{$pgw->id}}">
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


<!-- Add Modal -->
<div class="modal fade" id="addJabatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Sales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="jabatan/add" method="POST" id="form-addsales">
        @CSRF
        <div class="modal-body">
          <div class="form-group">
            <label for="inputAddress2">Kode</label>
            <input type="text" class="form-control" name="kode" placeholder="HRD">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Jabatan</label>
            <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" name="nama_jabatan" placeholder="Human Resource Directory">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" id="submit" name="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
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


