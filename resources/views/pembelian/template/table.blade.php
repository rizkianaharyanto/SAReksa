@extends('pembelian.template.templatebaru')
@section('isi')
@parent

<div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                <strong class="card-title">@yield('judul')</strong>
                                  @yield('tambah')
                                </div>
                            </div>
                            <div class="card-body">
                              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                    @yield('thead')
                                    </thead>
                                    <tbody>
                                    @yield('tbody')
                                    </tbody>
                                </table>
                            </div>
                            </div>
                    </div>    
                </div>
            </div>
                    
<!-- <div class="d-flex justify-content-center" style="position: relative; color:black; margin-top:2vw;">
  <div style="z-index: 1; margin-left:45vw;">
    <a data-toggle="modal" data-target="#@yield('tambah')modalTambah">
      <i id="tambah" onmouseover="tulisan()" class="fas fa-plus mr-4" style="font-size:30px;color:#00BFA6; cursor: pointer;">
        <span></span>
      </i>
    </a>
    
    
  </div>
  <div style="position: absolute">
    <table id="table_id" class="table table-hover" style="width: 85vw">
      <thead style="background-color: #00BFA6; color:white;">
        
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div> -->



<script>
  $(document).ready(function() {
    $('#bootstrap-data-table-export').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });

</script>
    

@endsection