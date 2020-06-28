@extends('penjualan.template.template', [
    'elementActive' => 'laporan'
])

@section('judul', 'Laporan')

@section('menu','Laporan')
    
@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-body">
                                        <div class='container form-group row mx-5 mb-5'>
                                            <div class='col-sm-4'>
                                                <div class="alert alert-primary mt-3 mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                    <span style="cursor: pointer; font-size:15px; color:black;background-color:white" href="#collapseExample" data-toggle="collapse" class="mx-2">Penjualan                                                     <b class="caret"></b>
                                                </span>
                                                </div>
                                                <div class="collapse" id="collapseExample">
                                                    <ul class="">
                                                        <li class="">
                                                            <div class="alert alert-primary  mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span data-toggle="modal" data-target="#modalsort" style="cursor: pointer;" class="mx-2">Penawaran Penjualan</span>
                                                            </div>                                                        
                                                        </li>
                                                        <li class="">
                                                            <div class="alert alert-primary mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span data-toggle="modal" data-target="#modalpemesanan" style="cursor: pointer;" class="mx-2">Pemesanan Penjualan</span>
                                                            </div>                                                        
                                                        </li>
                                                        <li class="">
                                                            <div class="alert alert-primary mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span data-toggle="modal" data-target="#modalfaktur" style="cursor: pointer;" class="mx-2">Faktur Penjualan</span>
                                                            </div>                                                        
                                                        </li>
                                                        <li class="">
                                                            <div class="alert alert-primary mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span style="cursor: pointer;" data-toggle="modal" data-target="#modalretur" class="mx-2">Retur Penjualan</span>
                                                            </div>                                                        
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class='col-sm-4'>
                                                <div class="alert alert-primary mt-3 mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                    <span style="cursor: pointer; font-size:15px; color:black;background-color:white" href="#collapseKirim" data-toggle="collapse" class="mx-2">Pengiriman                                                     <b class="caret"></b>
                                                </span>
                                                </div>
                                                <div class="collapse" id="collapseKirim">
                                                    <ul class="">
                                                        <li class="">
                                                            <div class="alert alert-primary  mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span style="cursor: pointer;" class="mx-2" data-toggle="modal" data-target="#modalpengiriman">Pengiriman Pemesanan</span>
                                                            </div>                                                        
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class='col-sm-4'>
                                                <div class="alert alert-primary mt-3 mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                    <span style="cursor: pointer; font-size:15px; color:black;background-color:white" href="#collapsePiutang" data-toggle="collapse" class="mx-2">Daftar Piutang Usaha                                                     <b class="caret"></b>
                                                </span>
                                                </div>
                                                <div class="collapse" id="collapsePiutang">
                                                    <ul class="">
                                                        <li class="">
                                                            <div class="alert alert-primary  mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span style="cursor: pointer;" class="mx-2">Piutang</span>
                                                            </div>                                                        
                                                        </li>
                                                        <li class="">
                                                            <div class="alert alert-primary  mb-0 p-1" id="tambahbarang" style=" font-size:15px; color:black;background-color:white">
                                                                <span style="cursor: pointer;" class="mx-2">Pembayaran Piutang</span>
                                                            </div>                                                        
                                                        </li>
                                                    </ul>
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
    </div>
</div>

<!-- Sort Penawaran-->
<div style="color: black;" class="modal fade" id="modalsort" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex " id="exampleModalLongTitle">
            <h5 class="align-self-center">Penawaran Penjualan</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
      <form method="POST" action="laporans/penawaran">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="nama_penjual">Bulan</label>
                <select style="height: 30px" class="form-control" onchange="isi(this)" id="bulan" name="bulan">
                    <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option>                    <option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                </select>             
                <!-- <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder=""> -->

            </div>
            <div class="col-md-6">
                <label for="nama_penjual">Tahun</label>
                <input type="number" min="0" class="form-control" id="tahun" name="tahun" placeholder="" required/>
            </div>
        </div>
      </div>
      <div id="footermodaltambah" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" style="background-color:#212120" class="btn ">Ok</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Sort Pemesanan-->
<div style="color: black;" class="modal fade" id="modalpemesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex " id="exampleModalLongTitle">
            <h5 class="align-self-center">Pemesanan Penjualan</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
      <form method="POST" action="laporans/pemesanan">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="nama_penjual">Bulan</label>
                <select style="height: 30px" class="form-control" onchange="isi(this)" id="bulan" name="bulan">
                    <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option>                    <option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                </select>             
                <!-- <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder=""> -->

            </div>
            <div class="col-md-6">
                <label for="nama_penjual">Tahun</label>
                <input type="number" class="form-control" id="tahun" min="0" name="tahun" placeholder="" required/>
            </div>
        </div>
      </div>
      <div id="footermodaltambah" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" style="background-color:#212120" class="btn ">Ok</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Sort Faktur-->
<div style="color: black;" class="modal fade" id="modalfaktur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex " id="exampleModalLongTitle">
            <h5 class="align-self-center">Faktur Penjualan</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
      <form method="POST" action="laporans/faktur">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="nama_penjual">Bulan</label>
                <select style="height: 30px" class="form-control" onchange="isi(this)" id="bulan" name="bulan">
                    <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option>                    <option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                </select>             
                <!-- <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder=""> -->

            </div>
            <div class="col-md-6">
                <label for="nama_penjual">Tahun</label>
                <input type="number" class="form-control" id="tahun" min="0" name="tahun" placeholder="" required/>
            </div>
        </div>
      </div>
      <div id="footermodaltambah" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" style="background-color:#212120" class="btn ">Ok</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Sort Retur-->
<div style="color: black;" class="modal fade" id="modalretur" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex " id="exampleModalLongTitle">
            <h5 class="align-self-center">Retur Penjualan</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
      <form method="POST" action="laporans/retur">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="nama_penjual">Bulan</label>
                <select style="height: 30px" class="form-control" onchange="isi(this)" id="bulan" name="bulan">
                    <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option>                    <option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                </select>             
                <!-- <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder=""> -->

            </div>
            <div class="col-md-6">
                <label for="nama_penjual">Tahun</label>
                <input type="number" class="form-control" id="tahun" min="0" name="tahun" placeholder="" required/>
            </div>
        </div>
      </div>
      <div id="footermodaltambah" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" style="background-color:#212120" class="btn ">Ok</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Sort Pengiriman-->
<div style="color: black;" class="modal fade" id="modalpengiriman" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div id="lebarmodaltambah" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex " id="exampleModalLongTitle">
            <h5 class="align-self-center">Pengiriman Pemesanan</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
      <form method="POST" action="laporans/pengiriman">
        @csrf
        <div class="form-row">
            <div class="col-md-6">
                <label for="nama_penjual">Bulan</label>
                <select style="height: 30px" class="form-control" onchange="isi(this)" id="bulan" name="bulan">
                    <option value="1">Januari</option><option value="2">Februari</option><option value="3">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option>                    <option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>
                </select>             
                <!-- <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" placeholder=""> -->

            </div>
            <div class="col-md-6">
                <label for="nama_penjual">Tahun</label>
                <input type="number" class="form-control" id="tahun" min="0" name="tahun" placeholder="" required/>
            </div>
        </div>
      </div>
      <div id="footermodaltambah" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" style="background-color:#212120" class="btn ">Ok</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection

