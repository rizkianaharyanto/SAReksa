@extends('penjualan.template.table', [
    'elementActive' => 'faktur'
])
@section('judul', 'Faktur')

@section('menu', 'Tambah Faktur')

@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <div id="stepper" class="bs-stepper align-self-end" style=" width:80vw; max-height:60vh; color:black;">
                                                <div class="bs-stepper-header">
                                                    <div class="step" data-target="#test-l-1">
                                                        <button type="button" class="btn step-trigger">
                                                            <span class="bs-stepper-circle">1</span>
                                                            <span class="bs-stepper-label">
                                                                ID
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div class="line"></div>
                                                    <div class="step" data-target="#test-l-2">
                                                        <button type="button" class="btn step-trigger">
                                                            <span class="bs-stepper-circle">2</span>
                                                            <span class="bs-stepper-label">Barang</span>
                                                        </button>
                                                    </div>
                                                    <div class="line"></div>
                                                    <div class="step" data-target="#test-l-3">
                                                        <button type="button" class="btn step-trigger">
                                                            <span class="bs-stepper-circle">3</span>
                                                            <span class="bs-stepp   er-label">Biaya Lain</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bs-stepper-content">
                                                    <form method="POST" action="/penjualan/fakturs">
                                                        @csrf
                                                        <div id="test-l-1" class="content">
                                                        <input type="hidden" id="gudang" name="gudang">
                                                            <input type="hidden" id="penjual_id" name="penjual_id">
                                                            <input type="hidden" id="status" name="status" value="piutang">
                                                            <input type="hidden" id="akun_barang" name="akun_barang">
                                                            <input type="hidden" id="piutang" name="piutang">
                                                            <div style="height: 58vh;overflow: auto; color:black" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                                                                            <option value="" >--- Pilih Pelanggan ---</option>
                                                                            @foreach ($pelanggans as $pelanggan)
                                                                            <option value="{{$pelanggan->id}}">{{ $pelanggan->nama_pelanggan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/penjualan/fakturs">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.next()">Selanjutnya</a>
                                                            </div>
                                                        </div>
                                                        <div id="test-l-2" class="content">
                                                            <div class="d-flex justify-content-center">
                                                                <p class="mr-5">Buat Faktur berdasarkan : </p>
                                                                <input class="mx-2" type="radio" name="radio" onclick="checkBarang(this)" />
                                                                <p class="mr-3">Pemesanan</p>
                                                                <div class="mr-5" id="pemesanan_form" style="display: none; background-color:black">
                                                                    <select  class="form-control" id="pemesanan_id" name="pemesanan_id">
                                                                        <option value="">--- Pilih Pemesanan ---</option>'
                                                                    </select>
                                                                </div>
                                                                <input class="mx-2" type="radio" name="radio" onclick="checkPenerimaan(this)" />
                                                                <p class="mr-3">Pengiriman</p>
                                                            </div>
                                                            <hr>
                                                            <div style="display:none" id="checkBarang">
                                                                <div style="overflow: auto; height: 41vh;" id="formbarang">
                                                                    <div class="form-row mx-5" id="isiformbarang0">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="barang_id" id="lbl">Barang</label>
                                                                            <select class="form-control" onchange="isi(this)" id="barang_id" name="barang_id[]">
                                                                                <option value="">--- Pilih Barang ---</option>
                                                                                @foreach ($barangs as $barang)
                                                                                <option value="{{$barang->id}}">{{ $barang->nama_barang }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <label for="jumlah_barang">QTY</label>
                                                                            <input type="number" style="height: 38px"  min="0" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onfocus="startCalc(this);" onblur="stopCalc();" placeholder="-">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="satuan_unit">Unit</label>
                                                                            <input type="number" style="height: 38px"  min="0" class="form-control" id="uni" disabled>
                                                                            <input type="hidden" id="unit" name="unit_barang[]">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="harga">Harga Satuan</label>
                                                                            <div class="input-group mb-2">
                                                                                <div style="height: 38px" class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input style="height: 38px" type="number" min="0" class="form-control" id="harga" name="harga[]" onfocus="startCalc(this);" onblur="stopCalc();" placeholder="-">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="total">Total</label>
                                                                            <div class="input-group mb-2">
                                                                                <div style="height: 38px" class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input style="height: 38px" type="number" min="0" class="form-control" id="total" name="total[]" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <p style="color: transparent">#</p>
                                                                            <a onclick="hapus(this)">
                                                                                <i style="color:grey;" class="fas fa-trash"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="display:none" id="checkPenerimaan">
                                                                <div style="overflow: auto; height: 41vh;" id="formpengiriman">
                                                                    <div class="form-row mx-5" id="isiformpengiriman0">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="pengiriman_id">Pengiriman</label>
                                                                            <select style="height: 43px" class="form-control" id="pengiriman_id" onchange="isipengiriman(this)" name="pengiriman_id[]" >
                                                                                <option value="">--- Pilih Pengiriman ---</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="tanggal_pengiriman">Tanggal</label>
                                                                            <input type="date" class="form-control" id="tanggal_pengiriman" disabled>
                                                                            <input type="hidden" id="discpnm" name="discpnm[]">
                                    <input type="hidden" id="biypnm" name="biypnm[]">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="total">Total</label>
                                                                            <div class="input-group mb-2">
                                                                                <div style="height: 43px" class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input type="number"style="height: 43px" min="0" class="form-control" id="total_pengiriman" name="total_pengiriman[]" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <p style="color: transparent">#</p>
                                                                            <a onclick="hapus(this)">
                                                                                <i style="color:grey;" class="fas fa-trash"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="alert alert-success mt-3 mb-0 p-1" id="tambahpengiriman" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;color: white;background-color:#212120" role='alert'>
                                                                    <i class="fas fa-plus d-flex justify-content-center">
                                                                    <span class="mx-2">Tambah Pengiriman</span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="d-flex mr-auto">
                                                                    <p class="m-2">Total </p>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp</div>
                                                                        </div>
                                                                        <input style="width:26vw" type="number"min="0"  name="total_harga_barang" id="total_harga_barang" disabled>
                                                                    </div>
                                                                </div>
                                                                <a href="/penjualan/fakturs">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.previous()">Sebelumnya</a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.next()">Selanjutnya</a>
                                                            </div>
                                                        </div>
                                                        <div id="test-l-3" class="content">
                    <div style="height: 58vh;overflow:auto" class="mt-2">
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="diskon">Diskon</label>
                            <div class="col-sm-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    <input type="number" min="0" class="form-control" id="disko" onchange="disc();" placeholder="-" disabled>
                                    <input type="hidden" class="form-control" id="diskon" name="diskon" placeholder="-">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" min="0" class="form-control" id="diskoo" onchange="disc();" placeholder="-" disabled>
                                    <input type="hidden" class="form-control" id="disk"  name="disk" placeholder="-">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="biaya_lain">Biaya lain</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" min="0" class="form-control" name="biaya_lain" onchange="disc();" id="biaya_lain" placeholder="-">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="termin_pembayaran">Termin Pembayaran</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="termin_pembayaran" name="termin_pembayaran">
                                    <option value="">--- Pilih Termin ---</option>
                                    <option value="">0 % 0 Net 0</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group row mx-5 mb-5" id="uang-muka-form">
                            <label class="col-sm-3 col-form-label" for="uang_muka">Uang Muka</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" min="0" class="form-control" id="uang_muka" onchange="disc()" name="uang_muka" value="0" placeholder="-">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex mr-auto">
                            <p class="m-2" id="sisa">Sisa </p>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input style="width:26vw" type="number" min="0" id="total_harga_kes" disabled>
                                <input type="hidden" name="total_harga_keseluruhan" id="total_harga_keseluruhan">
                            </div>
                            <input class="ml-4 mt-2" type="checkbox" onclick="checkLunas(this)" />
                            <h5 class="ml-2">Lunas</h5>
                        </div>                                                                <a href="/penjualan/fakturs">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.previous()">Sebelumnya</a>
                                                                <button type="submit" class="btn" style="background-color:#212120; color:white">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </form>
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


<script>
    var message = '{{ Session::get('message')}}';
    var status = '{{ Session::get('status')}}';
    if(message){
      $(document).ready(function() {
        console.log(message)
        $.notify({
        icon: "fa fa-times",
        type: 'success',
        message: message
      },{
          timer: 200,
          placement: {
              from: 'top',
              align: 'right'
          },
          template: '<div class="alert alert-danger alert-with-icon alert-dismissible fade show" data-notify="container">' +
                    '<button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<i class="fa fa-remove fa-5x"></i>'+
                    '</button>'+
                    '<span data-notify="icon" class="{0}"></span>'+
                    '<span data-notify="message">{2}</span>'+
                  '</div>'
        });
      });
      
    }    

    var stepperNode = document.querySelector('#stepper')
    var stepper = new Stepper(document.querySelector('#stepper'))

    stepperNode.addEventListener('show.bs-stepper', function(event) {
        console.warn('show.bs-stepper', event)
    })
    stepperNode.addEventListener('shown.bs-stepper', function(event) {
        console.warn('shown.bs-stepper', event)
    })

    function grey(x) {
        x.style.background = "#212120";
        x.style.color = "white";
    }

    function green(x) {
        x.style.background = "white";
        x.style.color = "#212120";
    }

    function checkBarang(x) {
        $('#pemesanan_form').removeAttr('style')
        $('#pemesanan_form').css('margin-top','-8px')
        $("#checkBarang").css('display', 'none')
        $("#checkPenerimaan").css('display', 'none')
    }

    function checkPenerimaan(x) {
        window.value=1;
        $("#checkBarang").css('display', 'none')
        $("#pemesanan_form").css('display', 'none')
        $("#checkPenerimaan").removeAttr('style')
        $(document.body).click(function() {
            var totpen = document.getElementsByName('total_pengiriman[]');
            var totp = 0;
            for (var i = 0; i < totpen.length; i++) {
                if (parseInt(totpen[i].value))
                    totp += parseInt(totpen[i].value);
            }
            // console.log(totp)
            document.getElementById('total_harga_barang').value = totp;
        })
    }

    function checkLunas(x) {
        if ($(x).attr('value') == "1") {
            $(x).removeAttr('value')
            $("#uang-muka-form").removeAttr('style')
            $('#sisa').html('Sisa')
            $("#akun-form").css('display', 'none')
            $("#status").val('piutang')
        } else {
            $(x).attr('value', '1')
            $("#akun-form").removeAttr('style')
            $("#sisa").html('Total')
            $("#uang-muka-form").css('display', 'none')
            $("#status").val('lunas')
        }
    }

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang0' || $(x).parent().parent().attr('id') != 'isiformpengiriman0') {
            $(x).parent().parent().remove();
        }
    }

    $('#tambahpengiriman').click(function() {
        var i = 0;
        $("#formpengiriman").append($("#isiformpengiriman0").clone().attr('id', 'isiformpengiriman' + (i + 1)));
        $(document.querySelectorAll("#isiformpengiriman1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
    });

    $('#pelanggan_id').change(function() {
        $.ajax({
            url: '/penjualan/pelanggans/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log(data)
                $('#pemesanan_id').removeAttr('disabled')
                if(data.pemesananfakturs != null){
                    for (i = 0; i < 10; i++) {
                        $('#pemesananoption').remove();
                    }
                    $('#penawaran_id').append('<option value="" id="pemesananoption">  --- Pilih Penawaran ---  </option>') 
                    for (i = 0; i < data.pemesananfakturs.length; i++) {
                        $('#pemesanan_id').append('<option id="pemesananoption" value="' + data.pemesananfakturs[i].id + '">' + data.pemesananfakturs[i].kode_pemesanan + '</option>')
                    }
                }
                for (i = 0; i < 10; i++) {
                        $('#pengirimanoption').remove();
                    }
                for (a = 0; a < data.pengirimanfakturs.length; a++) {
                    console.log(data.pengirimanfakturs[a].id)
                    $('#pengiriman_id').append('<option id="pengirimanoption" value="' + data.pengirimanfakturs[a].id + '">' + data.pengirimanfakturs[a].kode_pengiriman + '</option>')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    $("#pemesanan_id").change(function() {
        $.ajax({
            url: '/penjualan/pemesanans/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                if (data.success == true) {
                    console.log(data)
                    $('#gudang').val(data.pemesanan.gudang)
                    $('#penjual_id').val(data.pemesanan.penjual_id)
                    $("#checkBarang").removeAttr('style')
                    $("#checkPenerimaan").css('display', 'none')
                    $('#diskon').val(data.pemesanan.diskon)
                    $('#diskon').val(data.pemesanan.diskon)
                    $('#disko').val(data.pemesanan.diskon)
                    $('#disk').val(data.pemesanan.diskon_rp)
                    $('#total_harga_barang').val(data.subtotal_psnfak)
                    $('#total_harga_kes').val(data.total_seluruh_psnfak)
                    $('#total_harga_keseluruhan').val(data.total_seluruh_psnfak)
                    $('#biaya_lain').val(data.pemesanan.biaya_lain)
                    $('#barang_id').val(data.barangs[0].id)
                    $('#unit').val(data.barangs[0].pivot.unit)
                    $('#uni').attr('placeholder',data.barangs[0].pivot.unit)
                    $('#jumlah_barang').val(data.barangs[0].pivot.jumlah_barang)
                    $('#harga').val(data.barangs[0].pivot.harga)
                    for (var i = 1; i <= data.barangs.length - 1; i++) {
                        $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                        $("#isiformbarang" + i).children().children('select').val(data.barangs[i].id)
                        $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangs[i].pivot.jumlah_barang)
                        $("#isiformbarang" + i).children().children('#unit').val(data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children('#uni').attr('placeholder',data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                    }
                    var c = data.barangs.length
                    console.log(c)
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    function isipengiriman(x) {
        console.log('minta')
        $.ajax({
            url: '/penjualan/pengirimans/' + $(x).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log(data)
                if (data.success == true) {
                    $('#penjual_id').val(data.pengiriman.penjual_id)
                    $('#gudang').val(data.pengiriman.gudang)
                    console.log(data.pengiriman.penjual_id)
                    $(x).parent().parent().children().children('#tanggal_pengiriman').val(data.pengiriman.tanggal)
                    $('#discpnm').val(data.pengiriman.diskon_rp)
                    console.log(data.pengiriman.diskon_rp)
                    $('#biypnm').val(data.pengiriman.biaya_lain)
                    var arr = document.getElementsByName('discpnm[]');
                    var discpnm = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (parseInt(arr[i].value))
                            discpnm += parseInt(arr[i].value);
                    }
                    var array = document.getElementsByName('biypnm[]');
                    var biypnm = 0;
                    for (var i = 0; i < array.length; i++) {
                        if (parseInt(array[i].value))
                            biypnm += parseInt(array[i].value);
                    }
                    $('#biaya_lain').val(biypnm)
                    $('#disk').val(discpnm)
                    $('#diskon').val(0)
                    $('#disko').val(0)
                    $('#diskoo').val(discpnm)
                    $('#diskon').css('display', 'none')
                    $(x).parent().parent().children().children().children('#total_pengiriman').val(data.pengiriman.total_jenis_barang)
                    if($("#isiformbarang0").children().children('#jumlah_barang').val().length == 0){
                        console.log("kosong")
                        $('#barang_id').val(data.barangs[0].id)
                        $('#unit').val(data.barangs[0].pivot.unit)
                        $('#uni').attr('placeholder',data.barangs[0].pivot.unit)
                        $('#jumlah_barang').val(data.barangs[0].pivot.jumlah_barang)
                        $('#harga').val(data.barangs[0].pivot.harga)
                        for (var i = 1; i <= data.barangs.length - 1; i++) {
                            $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                            $("#isiformbarang" + i).children().children('select').val(data.barangs[i].id)
                            $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangs[i].pivot.jumlah_barang)
                            $("#isiformbarang" + i).children().children('#uni').attr('placeholder',data.barangs[i].pivot.unit)
                            $("#isiformbarang" + i).children().children('#unit').val(data.barangs[i].pivot.unit)
                            $("#isiformbarang" + i).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                            window.value++;
                        }
                    }
                    else{
                        console.log("ada")
                        console.log(window.value)
                        for (var i = 0; i <= data.barangs.length-1 ; i++) {
                            $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + window.value));
                            $("#isiformbarang" + window.value).children().children('select').val(data.barangs[i].id)
                            $("#isiformbarang" + window.value).children().children('#jumlah_barang').val(data.barangs[i].pivot.jumlah_barang)
                            $("#isiformbarang" + window.value).children().children('#uni').attr('placeholder',data.barangs[i].pivot.unit)
                            $("#isiformbarang" + window.value).children().children('#unit').val(data.barangs[i].pivot.unit)
                            $("#isiformbarang" + window.value).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                            window.value++;
                        }
                    }
                    // $('#barang_id').val(data.barangs[0].id)
                    // $('#unit').val(data.barangs[0].pivot.unit)
                    // $('#uni').attr('placeholder',data.barangs[0].pivot.unit)
                    // $('#jumlah_barang').val(data.barangs[0].pivot.jumlah_barang)
                    // $('#harga').val(data.barangs[0].pivot.harga)
                    // for (var i = 1; i <= data.barangs.length - 1; i++) {
                    //     $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                    //     $("#isiformbarang" + i).children().children('select').val(data.barangs[i].id)
                    //     $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangs[i].pivot.jumlah_barang)
                    //     $("#isiformbarang" + i).children().children('#uni').attr('placeholder',data.barangs[i].pivot.unit)
                    //     $("#isiformbarang" + i).children().children('#unit').val(data.barangs[i].pivot.unit)
                    //     $("#isiformbarang" + i).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                    // }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('hmm')
            }
        });
    };

    function disc() {
    dis = parseInt($('#diskon').val()) / 100;
        biy = parseInt($('#biaya_lain').val());
        dp = parseInt($('#uang_muka').val());
        barang = parseInt($('#total_harga_barang').val())
        $('#akun_barang').val(barang)

        var arr = document.getElementsByName('discpnm[]');
        var discpnm = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseInt(arr[i].value))
                discpnm += parseInt(arr[i].value);
        }

        diskon = parseInt(barang * dis) + discpnm;
        $('#disk').val(diskon)
        $('#diskoo').val(diskon)
        barangafterdiskon = barang - diskon
        hutang = barangafterdiskon + biy - dp
        $('#hutang').val(hutang)
        if (hutang) {
            $('#total_harga_kes').val(hutang)
            $('#total_harga_keseluruhan').val(hutang)
        }
        console.log(
            'barang:', barang,
            'dis:', dis,
            'diskon:', diskon,
            'hutang:', hutang,
            'biaya:', biy,
            'dp:', dp,
        )
    }


    function startCalc(x) {
        if ($(x).attr('id') == 'jumlah_barang') {
            a = x
            b = $(x).parent().parent().children().children().children('#harga')
            c = $(x).parent().parent().children().children().children('#total')
            interval = setInterval(function() {
                qty = $(a).val();
                harga = $(b).val();
                total = qty * harga
                $(c).val(total)
            }, 1);
        } else if ($(x).attr('id') == 'harga') {
            a = $(x).parent().parent().parent().children().children('#jumlah_barang')
            b = x
            c = $(x).parent().parent().parent().children().children().children('#total')
            interval = setInterval(function() {
                qty = $(a).val();
                harga = $(b).val();
                total = qty * harga
                $(c).val(total)
            }, 1);
        }
    }

    function stopCalc() {
        clearInterval(interval);
        var arr = document.getElementsByName('total[]');
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        document.getElementById('total_harga_barang').value = tot;
        document.getElementById('total_harga_keseluruhan').value = tot;
    }

    function isi(x) {
        console.log('isi')
        $.ajax({
            url: '/stok/Management-Data/barang/' + $(x).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log(data)
                var unit = $(x).parent().parent().children().children('#uni').attr('placeholder', data.unit.nama_satuan)
                $(x).parent().parent().children().children('#unit').val(data.unit.nama_satuan)
                var harga = $(x).parent().parent().children().children().children('#harga').val(data.harga_retail)
                console.log(unit)
            }
        })
    }
</script>

@endsection