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
  <table id="table_id" class="table table-hover">
      <thead style="background-color: #4b4b4b; color:white;">
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>email</th>
              <th>Userable ID</th>
              <th>Userable Type</th>
              <th style="alignment:justify, width:50px">Aksi</th>
          </tr>
      </thead>
      <tbody style=" color:white;">
        @foreach($users as $indexKey => $user)

          <tr>
              <td>{{ $indexKey+1 }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->userable_id }}</td>
              <td>{{ $user->userable_type }}</td>
              <td>
                <a href="pph/{{$user->id}}">
                  <button class="btn btn-success">Reset Password</button>
                </a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#HapusModal{{ $user->id }}">Hapus</button>
              </td>
          </tr>

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
                      <p>Yakin hapus data PPH yang dipilih?</p>
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


@endsection


