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


<script>
  $(document).ready(function() {
    $('#bootstrap-data-table-export').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>


@endsection