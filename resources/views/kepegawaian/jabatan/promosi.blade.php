@extends('kepegawaian.sidebar')

@section('content')
   <a href="promosi/tambah">
    <button type="button" class="btn btn-primary mb-3">
      <i class="fas fa-plus-square mr-1"></i>
      Ubah Jabatan Pegawai
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
              <th>Tanggal Promosi</th>
              <th>Keterangan</th>
          </tr>
      </thead>
      <tbody style=" background-color:white ">
        @foreach($pegawais as $index => $pgw)

          <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $pgw->nama }}</td>
              <td>
                @foreach( $pgw->jabatans as $indexKey => $jbt )
                    {{ $jbt->nama_jabatan }} <br>
                @endforeach
              </td>
              <td>
                @foreach( $pgw->jabatans as $indexKey => $jbt )
                    {{ \Carbon\Carbon::parse($jbt->pivot->tanggal)->format('d-m-Y') }} <br>
                @endforeach
              </td>
              <td>
                @foreach( $pgw->jabatans as $indexKey => $jbt )
                    {{ $jbt->pivot->keterangan }} <br>
                @endforeach
              </td>
          </tr>

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


