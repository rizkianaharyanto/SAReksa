@extends('penjualan.template.table', [
    'elementActive' => 'pemesanan'
])
@section('judul', 'Pemesanan')

@section('menu', 'Tambah Pemesanan')

@section('content')
<div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style='margin-bottom:2px'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain" style='margin-bottom:-40px'>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <div id="stepper" class="bs-stepper align-self-end" style=" width:80vw; max-height:; color:#212120;">
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
                                                    <form method="POST" action="/penjualan/pemesanans">
                                                        @csrf
                                                        <div id="test-l-1" class="content">
                                                            <input type="hidden" id="status" name="status" value="baru">
                                                            <div style="height: ;overflow: auto; color:#212120" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select required class="form-control" id="pelanggan_id" name="pelanggan_id">
                                                                            <option value="" disabled selected hidden>--- Pilih Pelanggan ---</option>
                                                                            @foreach ($pelanggans as $pelanggan)
                                                                            <option value="{{$pelanggan->id}}">{{ $pelanggan->nama_pelanggan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5" id="penawaran_form" style=>
                                                                    <label class="col-sm-3 col-form-label" for="penawaran_id">Penawaran</label>
                                                                    <div class="col-sm-9">
                                                                        <select  class="form-control" id="penawaran_id" name="penawaran_id" disabled>
                                                                            <option value="" disabled selected hidden id="penawaranoption">--- Pilih Penawaran ---</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="penjual_id">Sales</label>
                                                                    <div class="col-sm-9">
                                                                        <select required class="form-control" id="penjual_id" name="penjual_id">
                                                                            <option value="" disabled selected hidden>--- Pilih Sales ---</option>
                                                                            @foreach ($penjuals as $penjual)
                                                                            <option value="{{$penjual->id}}">{{ $penjual->nama_penjual }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="gudang">Gudang</label>
                                                                    <div class="col-sm-9">
                                                                        <select required class="form-control" id="gudang" name="gudang">
                                                                            <option value="" disabled selected hidden>--- Pilih Gudang ---</option>
                                                                            @foreach ($gudangs as $gudang)
                                                                            <option value="{{$gudang->id}}">{{ $gudang->kode_gudang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                                                                    <div class="col-sm-9">
                                                                        <input required type="date" class="form-control" id="tanggal" name="tanggal">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer" >
                                                                <a href="/penjualan/pemesanans">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.next()">Selanjutnya</a>
                                                            </div>
                                                        </div>
                                                        <div id="test-l-2" class="content">
                                                            <div style="overflow: auto; height:;" id="formbarang">
                                                                <div class="form-row mx-5" id="isiformbarang0">
                                                                    <div class="col-md-3">
                                                                        <label for="barang_id" id="lbl">Barang</label>
                                                                        <select class="form-control" onchange="isi(this)" id="barang_id" name="barang_id[]">
                                                                            <option value="" disabled selected hidden>--- Pilih Barang ---</option>
                                                                            @foreach ($barangs as $barang)
                                                                            <option value="{{$barang->id}}">{{ $barang->nama_barang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label for="jumlah_barang">QTY</label>
                                                                        <input type="number" min="0"style="height: 38px" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onfocus="startCalc(this);" onblur="stopCalc();disc();" placeholder="-">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="satuan_unit">Unit</label>
                                                                        <input type="number" style="height: 38px" min="0" class="form-control" id="uni" disabled>
                                                                        <input type="hidden" id="unit" name="unit_barang[]">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="harga">Harga Satuan</label>
                                                                        <div class="input-group mb-2">
                                                                            <div style="height: 38px" class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="height: 38px" type="number"min="0" class="form-control" id="harga" name="harga[]"  onfocus="startCalc(this);" onblur="stopCalc();disc();" placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="total">Total</label>
                                                                        <div class="input-group mb-2">
                                                                            <div style="height: 38px" class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="height: 38px" type="number" min="0"class="form-control" id="total" name="total[]" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" id="status_barang" name="status_barang[]" value="belum terkirim">
                                                                    <div class="form-group col-md-1">
                                                                        <p style="color: transparent">#</p>
                                                                        <a  onclick="hapus(this)">
                                                                            <i id='sampah' style="color:grey;" class="fas fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="alert alert-success mt-3 mb-0 p-1" id="tambahbarang" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;color: white;background-color:#212120" role='alert'>
                                                                <i class="fas fa-plus d-flex justify-content-center">
                                                                    <span class="mx-2">Tambah Barang</span>
                                                                </i>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="d-flex mr-auto">
                                                                    <p class="m-2">Total </p>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp</div>
                                                                        </div>
                                                                        <input style="width:26vw" type="number" min="0"name="total_harga_barang" id="total_harga_barang" onchange="disc();" disabled>
                                                                    </div>
                                                                </div>
                                                                <a href="/penjualan/pemesanans">
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
                                                                            <input required type="number"min="0" class="form-control" max="100" id="diskon" onfocus="disc();" onchange="disc();" name="diskon" placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input required type="number" min="0"class="form-control" id="disk" onfocus="disc();" onchange="disc();" name="disk" placeholder="-">
                                                                        </div>
                                                                    </div>                                                                  </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="biaya_lain">Biaya lain</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input required type="number" min="0"class="form-control" name="biaya_lain" onfocus="disc();" onchange="disc();" id="biaya_lain" placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row m-5 d-flex justify-content-end">
                                                                    <label class="col-sm-3 col-form-label" for="total_harga_keseluruhan">Total</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="width:26vw" type="number" min="0"id="total_harga_kes" disabled>
                                                                            <input type="hidden" name="total_harga_keseluruhan" id="total_harga_keseluruhan">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/penjualan/penawarans">
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

    var i = 0;
    $('#tambahbarang').click(function() {
        console.log(i)
        $("#formbarang").append($("#isiformbarang" + i).clone().attr('id', 'isiformbarang' + (i + 1)));
        $("#isiformbarang" + (i+1)).children().children('#jumlah_barang').val("-");
        $("#isiformbarang" + (i+1)).children().children('#uni').attr('placeholder','-');
        $("#isiformbarang" + (i+1)).children().children().children('#total').val('-');
        $("#isiformbarang" + (i+1)).children().children().children('#harga').val('-');
        $(document.querySelectorAll("#isiformbarang"+ (i + 1))).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
        i++;
    });

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang0') {
            $(x).parent().parent().remove();
        }
    }

    $('#pelanggan_id').change(function() {
        console.log("test")
        $.ajax({
            url: '/penjualan/pelanggans/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log(data)
                $('#penawaran_id').removeAttr('disabled')
                for (i = 0; i < 10; i++) {
                    $('#penawaranoption').remove();
                }
                $('#penawaran_id').append('<option value="" id="penawaranoption" disabled selected hidden>  --- Pilih Penawaran ---  </option>') 
                for (i = 0; i < data.penawarans.length; i++) {
                    $('#penawaran_id').append('<option id="penawaranoption" value="' + data.penawarans[i].id + '">' + data.penawarans[i].kode_penawaran + '</option>')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    window.onload = function(){
        startCalc('#jumlah_barang');
    }
    $("#penawaran_id").change(function() {
        console.log("test")
        $.ajax({
            url: '/penjualan/penawarans/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                if (data.success == true) {
                    console.log(data)
                    console.log(data.penawaran)
                    console.log(data.barangs[0].pivot.jumlah_barang)
                    $('#gudang').val(data.penawaran.gudang)
                    $('#penjual_id').val(data.penawaran.penjual_id)
                    $('#diskon').val(data.penawaran.diskon)
                    $('#total_harga_keseluruhan').val(data.total_seluruh_pr)
                    $('#total_harga_barang').val(data.subtotal_pr)
                    $('#total_harga_kes').val(data.total_seluruh_pr)
                    $('#disk').val(data.penawaran.diskon_rp)
                    $('#biaya_lain').val(data.penawaran.biaya_lain)
                    $('#barang_id').val(data.barangs[0].id)
                    $('#unit').val(data.barangs[0].pivot.unit)
                    $('#uni').attr('placeholder',data.barangs[0].pivot.unit)
                    $('#jumlah_barang').val(data.barangs[0].pivot.jumlah_barang)
                    $('#harga').val(data.barangs[0].pivot.harga)
                    $('#total').val(data.total_harga_pr[0])
                    startCalc('#jumlah_barang');
                    $('#status_barang').val('belum terkirim')
                    for (var i = 1; i <= data.barangs.length - 1; i++) {
                        $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                        $("#isiformbarang" + i).children().children('select').val(data.barangs[i].id)
                        $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangs[i].pivot.jumlah_barang)
                        $("#isiformbarang" + i).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                        $("#isiformbarang" + i).children().children().children('#total').val(data.total_harga_pr[i])
                        $("#isiformbarang" + i).children().children('#unit').val(data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children('#uni').attr('placeholder',data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children('#status_barang').val('belum terkirim')
                        $("#isiformbarang" + i).children().children().children('#sampah').css({
                            'color': 'black',
                            'cursor': 'pointer'
                        })
                        // console.log(data.barangs[i].pivot.harga)
                        // $("#isiformbarang" + i).children().children('input').attr('id', 'total' + i)
                        // $('#total' + i).val(data.barangs[i].pivot.total)
                    }
                    var c = data.barangs.length
                    console.log(c)
                } else {
                    console.log(c)
                    $('#pelanggan_id').val('')
                    $('#gudang').val('')
                    $('#tanggal').val('')
                    $('#mata_uang').val('')
                    $('#diskon').val('')
                    $('#biaya_lain').val('')
                    // for (var b = 1; b <= c; b++) {
                    //     $(document.querySelectorAll("#isiformbarang" + b)).remove()
                    // }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    function disc() {
        dis = parseInt($('#diskon').val()) / 100;
        biy = parseInt($('#biaya_lain').val());
        console.log(biy);
        dp = 0
        barang = parseInt($('#total_harga_barang').val())
        $('#akun_barang').val(barang)
        diskon = parseInt(barang * dis)
        $('#disk').val(diskon)
        barangafterdiskon = barang - diskon
        piutang = barangafterdiskon + biy - dp
        $('#piutang').val(piutang)
        if (piutang) {
            $('#total_harga_kes').val(piutang)
            $('#total_harga_keseluruhan').val(piutang)
        }
        console.log(
            'barang:', barang,
            'dis:', dis,
            'diskon:', diskon,
            'piutang:', piutang,
            'biaya:', biy,
            'dp:', dp,
        )
    }


    function startCalc(x) {
        console.log('test')
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
        console.log('test')

        clearInterval(interval);
        var arr = document.getElementsByName('total[]');
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            console.log(arr[i].value)
            if (parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        console.log(tot)
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