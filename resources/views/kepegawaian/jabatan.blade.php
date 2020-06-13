@extends('kepegawaian.sidebar')

@section('content')
 
  <link rel="stylesheet" type="text/css" href="{{ url('/css/kepegawaian/dashboard.css') }}" />
  <h1><i class="fas fa-tachometer-alt mr-2 pt-2"></i>Jabatan</h1><hr>

  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addJabatanModal">
    <i class="fas fa-plus-square mr-1"></i>
    Tambah Jabatan
  </button>
  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
    <i class="fas fa-plus-square mr-1"></i>
    Edit Jabatan
  </button>
  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
    <i class="fas fa-plus-square mr-1"></i>
    Hapus Jabatan
  </button><br>

  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addBarangModal">
    <i class="fas fa-plus-square mr-1"></i>
    Promosi Jabatan Pegawai
  </button>




<!-- Add Sales Modal -->
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
      <form action="kepegawaian/jabatan/store" method="POST" id="form-addsales">
        @CSRF
        <div class="modal-body">
          <div class="form-group">
            <label for="inputAddress2">Kode</label>
            <input type="text" class="form-control" name="kode" placeholder="HRD" required>
          </div>
          <div class="form-group">
            <label for="inputAddress2">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" placeholder="Human Resource Directory" required>
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

@endsection


