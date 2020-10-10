@extends('kepegawaian.sidebar')

@section('content')
 
<a href="pengguna/tambah">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
      <i class="fas fa-plus-square mr-1"></i>
      Tambah Pengguna
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
              <th>email</th>
              <th>Userable ID</th>
              <th>Userable Type</th>
              <th style="alignment:justify, width:210px">Aksi</th>
          </tr>
      </thead>
      <tbody style=" background-color:white ">
        @foreach($users as $indexKey => $user)

          <tr>
              <td>{{ $indexKey+1 }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->userable_id }}</td>
              <td>{{ $user->userable_type }}</td>
              <td>
                <a>
                  <button class="btn btn-success" data-toggle="modal" data-target="#ResetModal{{ $user->id }}">Reset Password</button>
                </a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#HapusModal{{ $user->id }}">Hapus</button>
              </td>
          </tr>

          <!-- reset Modal -->
          <div class="modal fade" id="ResetModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Reset Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="pengguna/reset/{{ $user->id }}" method="POST" id="form-addsales">
                  @method('PUT')
                  @CSRF
                  <div class="modal-body">
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="password baru" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Reset</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Hapus Modal -->
          <div class="modal fade" id="HapusModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                      <p>Yakin hapus data Pengguna yang dipilih?</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="pengguna/hapus/{{$user->id}}">
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


