@extends('penjualan.template.table', [
    'elementActive' => 'retur'
])
@section('judul', 'Edit Retur Penjualan')

@section('menu', 'Edit Retur Penjualan')

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
                                                    <!-- <div class="line"></div>
                                                    <div class="step" data-target="#test-l-3">
                                                        <button type="button" class="btn step-trigger">
                                                            <span class="bs-stepper-circle">3</span>
                                                            <span class="bs-stepp   er-label">Biaya Lain</span>
                                                        </button>
                                                    </div> -->
                                                </div>
                                                <div class="bs-stepper-content">
                                                    <form method="POST" action="/penjualan/returs/{{$retur->id}}">
                                                        @method('put')
                                                        @csrf
                                                        <div id="test-l-1" class="content">
                                                            <input type="hidden" id="penjual_id" name="penjual_id">
                                                            <input type="hidden" id="status" name="status" value="piutang">
                                                            <input type="hidden" id="akun_barang" name="akun_barang">
                                                            <input type="hidden" id="piutang" name="piutang">
                                                            <div style="height: ;overflow: auto; color:black" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select required class="form-control" id="pelanggan_id" name="pelanggan_id">
                                                                            <option value="">--- Pilih Pelanggan ---</option>
                                                                            @foreach ($pelanggans as $pelanggan)
                                                                            <option value="{{$pelanggan->id}}"{{ $pelanggan->id ==  "$retur->pelanggan_id" ? "selected" : "" }}>{{ $pelanggan->nama_pelanggan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5" id="faktur_form" >
                                                                    <label class="col-sm-3 col-form-label" for="faktur_id">Faktur</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="faktur_id" name="faktur_id"  disabled>
                                                                        @foreach ($fakturs as $faktur)
                                                                        <option value="{{$retur->faktur_id}}" {{ $faktur->id ==  "$retur->faktur_id" ? "selected" : "" }} id="fakturoption">{{$faktur->kode_faktur}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                                                                    <div class="col-sm-9">
                                                                        <input required type="date" class="form-control" id="tanggal" name="tanggal" value="{{$retur->tanggal}}">
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
                                                            <div style="overflow: auto; height: ;" id="formbarang">
                                                            @foreach ($retur->barangs as $returbarang)
                                                                <div class="form-row mx-5" id="isiformbarang0">
                                                                    <div class="form-group col-md-3">
                                                                        <label for="barang_id" id="lbl">Barang</label>
                                                                        <select required class="form-control" id="barang_id" onchange="isi(this)" name="barang_id[]">
                                                                            <option value="">--- Pilih Barang ---</option>
                                                                            @foreach ($barangs as $barang)
                                                                            <option value="{{$barang->id}}" {{$barang->id == $returbarang->pivot->barang_id ? "selected" : "" }}>{{ $barang->nama_barang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-1">
                                                                        <label for="jumlah_barang">QTY</label>
                                                                        <input type="number"min="0"  class="form-control" id="jumlah_barang" name="jumlah_barang[]" onfocus="startCalc(this);" onblur="stopCalc();" value="{{$returbarang->pivot->jumlah_barang}}" placeholder="-">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="satuan_unit">Unit</label>                                                                            
                                                                        <input type="text" class="form-control" id="uni" value='' placeholder="{{$returbarang->pivot->unit}}" disabled>
                                                                            <input type="hidden" value="{{$returbarang->pivot->unit}}" id="unit" name="unit_barang[]">
                                                                    </div>
                                                                    <div class="form-group col-md-2">
                                                                        <label for="harga">Harga Satuan</label>
                                                                        <div class="input-group mb-2">
                                                                            <div style="height: 38px" class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="height: 38px" type="number" min="0" class="form-control" id="harga" name="harga[]" onfocus="startCalc(this);" value="{{$returbarang->pivot->harga}}" onblur="stopCalc();" placeholder="-">
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
                                                                @endforeach
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="d-flex mr-auto">
                                                                    <p class="m-2">Total </p>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp</div>
                                                                        </div>
                                                                        <input style="width:26vw" type="number" min="0" name="total_harga_barang" id="total_harga_barang" disabled>
                                                                        <input type="hidden" name="total_harga_barang" id="total_harga_barang">                                                                    </div>
                                                                </div>
                                                                <a href="/penjualan/returs">
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

    $('#tambahbarang').click(function() {
        var i = 0;
        $("#formbarang").append($("#isiformbarang" + i).clone().attr('id', 'isiformbarang' + (i + 1)));
        $(document.querySelectorAll("#isiformbarang1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
    });

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
        if ($(x).parent().parent().attr('id') != 'isiformbarang0') {
            $(x).parent().parent().remove();
        }
    }

    $('#pelanggan_id').change(function() {
        $.ajax({
            url: '/penjualan/pelanggans/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                $('#faktur_id').removeAttr('disabled')
                for (i = 0; i < 10; i++) {
                    $('#fakturoption').remove();
                }
                $('#faktur_id').append('<option value="" id="fakturoption">  --- Pilih Faktur ---  </option>') 
                for (i = 0; i < data.fakturs.length; i++) {
                    $('#faktur_id').append('<option id="fakturoption" value="' + data.fakturs[i].id + '">' + data.fakturs[i].kode_faktur + '</option>')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    $("#faktur_id").change(function() {
        $.ajax({
            url: '/penjualan/fakturs/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                if (data.success == true) {
                    console.log(data)
                    // $('#diskon').val(data.faktur.diskon)
                    // $('#biaya_lain').val(data.faktur.biaya_lain)
                    $('#penjual_id').val(data.faktur.penjual_id)
                    $('#barang_id').val(data.barangs[0].id)
                    $('#tambahbarang').detach()
                    $('#uni').attr('placeholder',data.barangs[0].pivot.unit)
                    $('#unit').val(data.barangs[0].pivot.unit)
                    $('#jumlah_barang').val(data.barangs[0].pivot.jumlah_barang)
                    $('#harga').val(data.barangs[0].pivot.harga)
                    for (var i = 1; i <= data.barangs.length - 1; i++) {
                        $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                        $("#isiformbarang" + i).children().children('select').val(data.barangs[i].id)
                        $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangs[i].pivot.jumlah_barang)
                        $("#isiformbarang" + i).children().children('#uni').attr('placeholder',data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children('#unit').val(data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                    }
                    var c = data.barangs.length
                    console.log(c)
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });


    // function disc() {
    //     dis = parseInt($('#diskon').val()) / 100;
    //     biy = parseInt($('#biaya_lain').val());
    //     dp = parseInt($('#uang_muka').val());
    //     barang = parseInt($('#total_harga_barang').val())
    //     $('#akun_barang').val(barang)
    //     diskon = (barang * dis)
    //     $('#disk').val(diskon)
    //     barangafterdiskon = barang - diskon
    //     piutang = barangafterdiskon + biy - dp
    //     $('#piutang').val(piutang)
    //     if (piutang) {
    //         $('#total_harga_kes').val(piutang)
    //         $('#total_harga_keseluruhan').val(piutang)
    //     }
    //     console.log(
    //         'barang:', barang,
    //         'dis:', dis,
    //         'diskon:', diskon,
    //         'piutang:', piutang, 
    //         'biaya:', biy,
    //         'dp:', dp,
    //     )
    // }


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
        console.log(tot)
        document.getElementById('total_harga_barang').value = tot;
        // document.getElementById('total_harga_keseluruhan').value = tot;
        document.getElementById('akun_barang').value = tot;
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