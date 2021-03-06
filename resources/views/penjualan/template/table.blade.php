@extends('penjualan.template.template', [
      'elementActive' => $elementActive
])

@section('content')
@parent
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-body">
                                      <div class="d-flex justify-content-center" style="position: relative; color:#212120; margin-top:-2.5%;">
                                        <div >
                                          <div class='d-flex justify-content-end' style='z-index: 1; padding-bottom:1%;'>
                                            @yield('tambah')
                                            <!-- <a data-toggle="modal" data-target="#modalFilter">
                                              <i id="tambah" onmouseover="tulisan()" class="fas fa-filter mr-4" style="font-size:25px;color:#212120;cursor: pointer;">
                                                <span></span>
                                              </i>
                                            </a> -->
                                          </div>
                                          <table id="table_id" class="table table-hover" style="width: 75vw">
                                            <thead style="background-color: #212120; color:white;">
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
                        </div>
                    </div>
                </div>
            </div>
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
        <button type="submit" style="background-color:#212120" class="btn ">Tambah</button>
      </div></form>
    </div>
  </div>
</div>

<!-- Notif -->
<script>
    $(document).ready(function() {
    var message = '{{ Session::get('message')}}';
    console.log('')
    })

    var message = '{{ Session::get('message')}}';
    var status = '{{ Session::get('status')}}';
    if(message){
      $(document).ready(function() {
        console.log(message)
        $.notify({
        icon: "fa fa-check",
        type: 'success',
        message: message
      },{
          timer: 200,
          placement: {
              from: 'top',
              align: 'right'
          },
          template: '<div class="alert alert-success alert-with-icon alert-dismissible fade show" data-notify="container">' +
                    '<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<i class="fa fa-remove fa-5x"></i>'+
                    '</button>'+
                    '<span data-notify="icon" class="{0}"></span>'+
                    '<span data-notify="message">{2}</span>'+
                  '</div>'
        });
      });
      
    }    
</script>

<script>
  $(document).ready(function() {
    $('#table_id').DataTable({
      "scrollCollapse": true,
    });
    $('.dataTables_length').addClass('bs-select');
  });

  
</script>
@endsection