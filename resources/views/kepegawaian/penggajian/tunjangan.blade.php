@extends('kepegawaian.sidebar')

@section('content')
 
  <a href="tunjangan/tambah">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJabatanModal">
      <i class="fas fa-plus-square mr-1"></i>
      Tambah tunjangan
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
              <th>Tunjangan</th>
              <th>tunjangan Beban</th>
              <th style="alignment:justify, width:150px">Aksi</th>
          </tr>
      </thead>
      <tbody style=" background-color:white ">
        @foreach($tunjangans as $indexKey => $tunjangan)

          <tr>
              <td>{{ $indexKey+1 }}</td>
              <td>{{ $tunjangan->nama_tunjangan }}</td>
              <td>{{ $tunjangan->akun->nama_akun }}</td>
              <td>
                <a href="tunjangan/{{$tunjangan->id}}">
                  <button class="btn btn-success">Ubah</button>
                </a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#HapusModal{{ $tunjangan->id }}">Hapus</button>
              </td>
          </tr>

          <!-- Hapus Modal -->
          <div class="modal fade" id="HapusModal{{ $tunjangan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                      <p>Yakin hapus data tunjangan yang dipilih?</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="tunjangan/hapus/{{$tunjangan->id}}">
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