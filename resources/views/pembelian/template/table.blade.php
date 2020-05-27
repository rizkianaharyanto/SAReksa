@extends('template.template')
@section('isi')
@parent
<div class="d-flex justify-content-center" style="position: relative; color:black; margin-top:2vw;">
  <div style="z-index: 1; margin-left:45vw;">
    <!-- <a data-toggle="modal" data-target="#@yield('tambah')modalTambah">
      <i id="tambah" onmouseover="tulisan()" class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
      </i>
    </a> -->
    @yield('tambah')
    <a data-toggle="modal" data-target="#modalFilter">
      <i id="tambah" onmouseover="tulisan()" class="fas fa-filter mr-4" style="font-size:25px;color:#00BFA6;cursor: pointer;">
        <span></span>
      </i>
    </a>
  </div>
  <div style="position: absolute">
    <table id="table_id" class="table table-hover" style="width: 85vw">
      <thead style="background-color: #00BFA6; color:white;">
        @yield('thead')
      </thead>
      <tbody>
        @yield('tbody')
      </tbody>
    </table>
  </div>
</div>

<!-- modal -->
<div style="color: black;" class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodal" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex" id="exampleModalLongTitle"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">

      </div>
      <div id="footermodal" class="modal-footer">

      </div>
    </div>
  </div>
</div>

<!-- tambah -->
<div style="color: black;" class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex" id="exampleModalLongTitle">@yield('judulTambah')</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
        @yield('bodyTambah')
      </div>
      <div id="footermodaltambah" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div></form>
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