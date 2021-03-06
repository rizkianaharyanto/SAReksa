@extends('penjualan.template.table', [
    'elementActive' => 'faktur'
])
@section('judul', 'Faktur')

@section('menu', 'Edit Faktur')

@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain" style='margin-bottom:-40px'>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <div id="stepper" class="bs-stepper align-self-end" style=" width:80vw; max-height:; color:black;">
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
                                                            <span class="bs-stepper-label">Biaya Lain</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bs-stepper-content">
                                                    <form method="POST" action="/penjualan/fakturs/{{$faktur->id}}">
                                                        @method('put')
                                                        @csrf
                                                        <div id="test-l-1" class="content">
                                                        <input type="hidden" id="pelanggan_id" name="pelanggan_id" value="{{ $faktur->pelanggan_id }}">
                                                        <input type="hidden" id="penjual_id" name="penjual_id" value="{{ $faktur->penjual_id }}">
                                                        <input type="hidden" id="status" name="status" value="{{ $faktur->status }}">
                                                        <input type="hidden" id="piutang" name="piutang">
                                                        <input type="hidden" id="akun_barang" name="akun_barang" value="{{ $faktur->akun_barang }}">
                                                            <div style="height: ;overflow: auto; color:black" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select disabled class="form-control" id="pelanggan_id">
                                                                            @foreach ($pelanggans as $pelanggan)
                                                                            <option value="{{$pelanggan->id}}"{{ $pelanggan->id ==  "$faktur->pelanggan_id" ? "selected" : "" }}>{{ $pelanggan->nama_pelanggan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" value="{{$faktur->tanggal}}"  class="form-control" name="tanggal" id="tanggal" placeholder="">
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
                                                            <div style="" id="checkBarang">
                                                                <div style="overflow: auto; height: ;" id="formbarang">
                                                                @foreach ($faktur->barangs as $fakturbarang)
                                                                    <div class="form-row mx-5" id="isiformbarang0">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="nama_barang" id="lbl">Barang</label>
                                                                            <select disabled class="form-control" onchange="isi(this)" id="barang_id_ui" name="barang_id_ui[]">
                                                                                @foreach ($barangs as $barang)
                                                                                <option value="{{$barang->id}}" {{$barang->id == $fakturbarang->pivot->barang_id ? "selected" : "" }}>{{ $barang->nama_barang }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <select hidden class="form-control" onchange="isi(this)" id="barang_id" name="barang_id[]">
                                                                                @foreach ($barangs as $barang)
                                                                                <option value="{{$barang->id}}" {{$barang->id == $fakturbarang->pivot->barang_id ? "selected" : "" }}>{{ $barang->nama_barang }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <label for="jumlah_barang">QTY</label>
                                                                            <input type="number" disabled style="height: 38px"  min="0" class="form-control"  onfocus="startCalc(this);" onblur="stopCalc();disc();"  id="jumlah_barang_ui" name="jumlah_barang_ui[]" value="{{$fakturbarang->pivot->jumlah_barang}}" placeholder="-">
                                                                            <input type="hidden"style="height: 38px"  min="0" class="form-control"  onfocus="startCalc(this);" onblur="stopCalc();disc();"  id="jumlah_barang" name="jumlah_barang[]" value="{{$fakturbarang->pivot->jumlah_barang}}" placeholder="-">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="satuan_unit">Unit</label>
                                                                            <input type="text" style="height: 38px" class="form-control" id="uni" value='' placeholder="{{$fakturbarang->pivot->unit}}" disabled>
                                                                            <input type="hidden" value="{{$fakturbarang->pivot->unit}}" id="unit" name="unit_barang[]">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="harga">Harga Satuan</label>
                                                                            <div class="input-group mb-2">
                                                                                <div style="height: 38px" class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input style="height: 38px" disabled type="number"min="0" class="form-control" onfocus="startCalc(this);" onblur="stopCalc()disc();" id="harga_ui" name="harga_ui[]" value="{{$fakturbarang->pivot->harga}}"  placeholder="-">
                                                                                <input style="height: 38px" type="hidden" min="0" class="form-control" onfocus="startCalc(this);" onblur="stopCalc()disc();" id="harga" name="harga[]" value="{{$fakturbarang->pivot->harga}}"  placeholder="-">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="total">Total</label>
                                                                            <div class="input-group mb-2">
                                                                                <div style="height: 38px" class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input style="height: 38px" type="number" min="0"class="form-control" id="total" name="total[]" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="form-group col-md-1">
                                                                            <p style="color: transparent">#</p>
                                                                            <a onclick="hapus(this)">
                                                                                <i style="color:grey;" class="fas fa-trash"></i>
                                                                            </a>
                                                                        </div> -->
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="d-flex mr-auto">
                                                                    <p class="m-2">Total </p>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp</div>
                                                                        </div>
                                                                        <input style="width:26vw" type="number" min="0"name="total_harga_barang" id="total_harga_barang" disabled>
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
                                                        <div style="height: ;overflow:auto" class="mt-2">
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="diskon">Diskon</label>
                            <div class="col-sm-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    <input type="number" min="0" max="100" class="form-control" value="{{$faktur->diskon}}"  id="disko" onchange="disc();" placeholder="-" disabled>
                                    <input type="hidden" class="form-control" id="diskon" name="diskon"value="{{$faktur->diskon}}"  placeholder="-">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" min="0" class="form-control" id="diskoo" value="{{$faktur->diskon_rp}}" onchange="disc();" placeholder="-" disabled>
                                    <input type="hidden" class="form-control" id="disk"  name="disk" value="{{$faktur->diskon_rp}}" placeholder="-">
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
                                    <input type="number" disabled min="0" class="form-control" name="biaya_lain_ui" onchange="disc();" value="{{$faktur->biaya_lain}}" id="biaya_lain_ui" placeholder="-">
                                    <input type="hidden" min="0" class="form-control" name="biaya_lain" onchange="disc();" value="{{$faktur->biaya_lain}}" id="biaya_lain" placeholder="-">
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
                                    <input type="number" min="0" class="form-control" id="uang_muka" onchange="disc()" name="uang_muka" value="{{$faktur->uang_muka}}"  placeholder="-">
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
                                <input style="width:26vw" type="number" min="0" value='{{$faktur->total_harga}}' id="total_harga_kes" disabled>
                                <input type="hidden" name="total_harga_keseluruhan" value='{{$faktur->total_harga}}' id="total_harga_keseluruhan">
                            </div>
                            <input class="ml-4 mt-2" id="lunas" type="checkbox" onclick="checkLunas(this)" />
                            <h5 class="ml-2">Lunas</h5>
                        </div>        
                                                                <a href="/penjualan/fakturs">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.previous()">Sebelumnya</a>
                                                                <button type="submit" class="btn" style="background-color:#212120; color:white">Ubah</button>
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
$(document).ready(function(){
    var status = '{{$faktur->status}}'
    console.log(status)
    if(status == "lunas"){
        // $("#lunas").attr('value', '1')
        $("#status").val('lunas')
            $("#akun-form").removeAttr('style')
            $("#sisa").html('Total')
            $("#uang-muka-form").css('display', 'none')
    }
});

$(document).ready(function(){
    $.ajax({
            url: '/penjualan/fakturs/' + {{$faktur->id}},
            type: 'get',
            data: {},
            success: function(data) {
            console.log(data)
            $('#total_harga_barang').val(data.subtotal_fk)
            $('#total').val(data.total_harga_fk[0])
            var harga=document.getElementsByName("total[]");
            console.log(harga)
            for (var i = 1; i <= data.barangs.length - 1; i++) {
                console.log(data.total_harga_fk[i])
                harga[i].value = data.total_harga_fk[i];
                }
            },
        error: function(jqXHR, textStatus, errorThrown) {}
    });
});


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

    var i = 0;
    $('#tambahbarang').click(function() {
        $("#formbarang").append($("#isiformbarang" + i).clone().attr('id', 'isiformbarang' + (i + 1)));
        $(document.querySelectorAll("#isiformbarang1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
    });
    $('#tambahpengiriman').click(function() {
        $("#formpengiriman").append($("#isiformpengiriman" + i).clone().attr('id', 'isiformpengiriman' + (i + 1)));
        $(document.querySelectorAll("#isiformpengiriman1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
    });

    function checkBarang(x) {
        $("#checkBarang").removeAttr('style')
        $("#checkPenerimaan").css('display', 'none')
    }

    function checkPenerimaan(x) {
        $("#checkBarang").css('display', 'none')
        $("#checkPenerimaan").removeAttr('style')
    }

    function checkLunas(x) {
        if ($(x).attr('value') == "1") {
            $(x).removeAttr('value')
            $("#uang-muka-form").removeAttr('style')
            $('#sisa').html('Sisa')
            $("#status").val('piutang')
            $("#akun-form").css('display', 'none')
        } else {
            $(x).attr('value', '1')
            $("#status").val('lunas')
            $("#akun-form").removeAttr('style')
            $("#sisa").html('Total')
            $("#uang-muka-form").css('display', 'none')
        }
    }

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang0' || $(x).parent().parent().attr('id') != 'isiformpengiriman0') {
            $(x).parent().parent().remove();
        }
    }

    function disc() {
    dis = parseInt($('#diskon').val()) / 100;
    console.log(dis)
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
        $("#uang_muka").attr({
                                "max" : hutang 
                            });
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
        console.log("testt")
        if ($(x).attr('id') == 'jumlah_barang') {
            a = x
            b = $(x).parent().parent().children().children().children('#harga')
            c = $(x).parent().parent().children().children().children('#total')
            console.log(b)
            interval = setInterval(function() {
                qty = $(a).val();
                harga = $(b).val();
                total = qty * harga
                $(c).val(total)
            }, 1);
        } else if ($(x).attr('id') == 'harga') {
            a = $(x).parent().parent().parent().children().children('#jumlah_barang')
            b = x
            console.log(b)
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
                    console.log(data.pengiriman.penjual_id)
                    $(x).parent().parent().children().children('#tanggal_pengiriman').val(data.pengiriman.tanggal)
                    $(x).parent().parent().children().children().children('#total_pengiriman').val(data.pengiriman.total_harga)
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
</script>

@endsection