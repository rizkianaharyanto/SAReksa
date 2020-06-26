@extends('pembelian.template.template')

@section('judul', 'tambah')

@section('halaman', 'Tambah Faktur')

@section('isi')

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
                    <span class="bs-stepper-label">Biaya Lain</span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <form method="POST" action="/pembelian/fakturs">
                @csrf
                <div id="test-l-1" class="content">
                    <input type="hidden" id="status" name="status" value="hutang">
                    <input type="hidden" id="akun_barang" name="akun_barang">
                    <input type="hidden" id="hutang" name="hutang">
                    <div style="height: 58vh;overflow: auto; color:black" class="mt-2">
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="pemasok_id">Pemasok</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="pemasok_id" name="pemasok_id">
                                    <option value="">--- Pilih pemasok ---</option>
                                    @foreach ($pemasoks as $pemasok)
                                    <option value="{{$pemasok->id}}">{{ $pemasok->nama_pemasok }}</option>
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
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="mata-uang">Mata Uang</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="mata_uang" name="mata_uang">
                                    <option value="">--- Pilih Mata Uang ---</option>
                                    <option value="">IDR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/pembelian/fakturs">
                            <button type="button" class="btn btn-secondary">Batal</button>
                        </a>
                        <a class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.next()">Selanjutnya</a>
                    </div>
                </div>
                <div id="test-l-2" class="content">
                    <div class="d-flex justify-content-center">
                        <p class="mr-5">Buat Faktur berdasarkan : </p>
                        <input class="mx-2" type="radio" name="radio" onclick="checkBarang(this)" />
                        <h5 class="mr-3">Pemesanan</h5>
                        <div class="mr-5" id="pemesanan_form" style="display: none;">
                            <select class="form-control" id="pemesanan_id" name="pemesanan_id">
                                <option value="">--- Pilih pemesanan ---</option>'
                            </select>
                        </div>
                        <input class="mx-2" type="radio" name="radio" onclick="checkPenerimaan(this)" />
                        <h5 class="mr-3">Penerimaan</h5>
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
                                    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onfocus="startCalc(this);" onblur="stopCalc();" placeholder="-">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="satuan_unit">Unit</label>
                                    <input type="number" class="form-control" id="uni" disabled>
                                    <input type="hidden" id="unit" name="unit_barang[]">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="harga">Harga Satuan</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="harga" name="harga[]" onfocus="startCalc(this);" onblur="stopCalc();" placeholder="-">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="total">Total</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="total" name="total[]" disabled>
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
                        <div style="overflow: auto; height: 41vh;" id="formpenerimaan">
                            <div class="form-row mx-5" id="isiformpenerimaan0">
                                <div class="form-group col-md-3">
                                    <label for="penerimaan_id">Penerimaan</label>
                                    <select class="form-control" id="penerimaan_id" onchange="isipenerimaan(this)" name="penerimaan_id[]" >
                                        <option value="">--- Pilih Penerimaan ---</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tanggal_penerimaan">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_penerimaan" disabled>
                                    <input type="hidden" id="discpnm" name="discpnm[]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="total">Total</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="total_penerimaan" name="total_penerimaan[]" disabled>
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
                        <div class="alert alert-primary mt-3 mb-0 p-1" id="tambahpenerimaan" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;">
                            <i class="fas fa-plus d-flex justify-content-center">
                                <span class="mx-2">Tambah Penerimaan</span>
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
                                <input style="width:26vw" type="number" name="total_harga_barang" id="total_harga_barang" disabled>
                            </div>
                        </div>
                        <a href="/pembelian/fakturs">
                            <button type="button" class="btn btn-secondary">Batal</button>
                        </a>
                        <a class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.previous()">Sebelumnya</a>
                        <a class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.next()">Selanjutnya</a>
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
                                    <input type="number" class="form-control" id="disko" onchange="disc();" placeholder="-" disabled>
                                    <input type="hidden" class="form-control" id="diskon" name="diskon" placeholder="-">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" class="form-control" id="diskoo" onchange="disc();" placeholder="-" disabled>
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
                                    <input type="number" class="form-control" name="biaya_lain" onchange="disc();" id="biaya_lain" placeholder="-">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="termin_pembayaran">Termin Pembayaran</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="termin_pembayaran" name="termin_pembayaran">
                                    <option value="">--- Pilih Termin ---</option>
                                    <option value="">0 % 0 Net 0</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mx-5 mb-5" id="uang-muka-form">
                            <label class="col-sm-3 col-form-label" for="uang_muka">Uang Muka</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" class="form-control" id="uang_muka" onchange="disc()" name="uang_muka" value="0" placeholder="-">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mx-5 mb-5" id="akun-form" style="display: none">
                            <label class="col-sm-3 col-form-label" for="akun">Akun</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="akun">
                                    <option>--- Pilih Akun ---</option>
                                    <!-- foreach ($akuns as $akun)
                                <option> $akun->nama_akun </option>
                                endforeach -->
                                </select>
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
                                <input style="width:26vw" type="number" id="total_harga_kes" disabled>
                                <input type="hidden" name="total_harga_keseluruhan" id="total_harga_keseluruhan">
                            </div>
                            <input class="ml-4 mt-2" type="checkbox" onclick="checkLunas(this)" />
                            <h5 class="ml-2">Lunas</h5>
                        </div>
                        <a href="/pembelian/fakturs">
                            <button type="button" class="btn btn-secondary">Batal</button>
                        </a>
                        <a class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.previous()">Sebelumnya</a>
                        <button type="submit" class="btn" style="background-color:#00BFA6; color:white">Tambah</button>
                    </div>
                </div>
            </form>
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

    function green(x) {
        x.className = "alert mt-3 alert-light mb-0 p-1";
    }

    function grey(x) {
        x.className = "alert mt-3 mb-0 p-1 alert-primary";
    }

    function checkBarang(x) {
        $('#pemesanan_form').removeAttr('style')
        $("#checkBarang").css('display', 'none')
        $("#checkPenerimaan").css('display', 'none')
    }

    function checkPenerimaan(x) {
        window.value=1;
        $("#checkBarang").css('display', 'none')
        $("#pemesanan_form").css('display', 'none')
        $("#checkPenerimaan").removeAttr('style')
        $(document.body).click(function() {
            var totpen = document.getElementsByName('total_penerimaan[]');
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
            $("#status").val('hutang')
        } else {
            $(x).attr('value', '1')
            $("#akun-form").removeAttr('style')
            $("#sisa").html('Total')
            $("#uang-muka-form").css('display', 'none')
            $("#status").val('lunas')
        }
    }

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang0' || $(x).parent().parent().attr('id') != 'isiformpenerimaan0') {
            $(x).parent().parent().remove();
        }
    }

    $('#tambahpenerimaan').click(function() {
        var i = 0;
        $("#formpenerimaan").append($("#isiformpenerimaan0").clone().attr('id', 'isiformpenerimaan' + (i + 1)));
        $(document.querySelectorAll("#isiformpenerimaan1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
    });

    $('#pemasok_id').change(function() {
        $.ajax({
            url: '/pembelian/pemasoks/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log(data)
                for (i = 0; i < data.fpemesanans.length; i++) {
                    if (data.fpemesanans[i].id == null){
                        $('#pemesanan_id').append('<option value="">' + data.fpemesanans[i] + '(Buat Berdasarkan Penerimaan)</option>')
                    }else{
                        $('#pemesanan_id').append('<option value="' + data.fpemesanans[i].id + '">' + data.fpemesanans[i].kode_pemesanan + '</option>')
                    }  
                }
                for (a = 0; a < data.fpenerimaans.length; a++) {
                    $('#penerimaan_id').append('<option value="' + data.fpenerimaans[a].id + '">' + data.fpenerimaans[a].kode_penerimaan + '</option>')
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    $("#pemesanan_id").change(function() {
        $.ajax({
            url: '/pembelian/pemesanans/' + $(this).val(),
            type: 'get',
            data: {},
            success: function(data) {
                if (data.success == true) {
                    console.log(data)
                    $("#checkBarang").removeAttr('style')
                    $("#checkPenerimaan").css('display', 'none')
                    $('#diskon').val(data.pemesanan.diskon)
                    $('#disko').val(data.pemesanan.diskon)
                    $('#disk').val(data.pemesanan.diskon_rp)
                    $('#diskoo').val(data.pemesanan.diskon_rp)
                    $('#biaya_lain').val(data.pemesanan.biaya_lain)
                    $('#barang_id').val(data.barangsfak[0].id)
                    $('#unit').val(data.barangsfak[0].pivot.unit)
                    $('#uni').attr('placeholder',data.barangsfak[0].pivot.unit)
                    $('#jumlah_barang').val(data.barangsfak[0].pivot.jumlah_barang)
                    $('#harga').val(data.barangsfak[0].pivot.harga)
                    for (var i = 1; i <= data.barangsfak.length - 1; i++) {
                        $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                        $("#isiformbarang" + i).children().children('select').val(data.barangsfak[i].id)
                        $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangsfak[i].pivot.jumlah_barang)
                        $("#isiformbarang" + i).children().children('#unit').val(data.barangsfak[i].pivot.unit)
                        $("#isiformbarang" + i).children().children('#uni').attr('placeholder',data.barangsfak[i].pivot.unit)
                        $("#isiformbarang" + i).children().children().children('#harga').val(data.barangsfak[i].pivot.harga)
                    }
                    var c = data.barangsfak.length
                    console.log(c)
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    function isipenerimaan(x) {
        console.log('minta')
        $.ajax({
            url: '/pembelian/penerimaans/' + $(x).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log('a:', data.penerimaan.diskon_rp)
                if (data.success == true) {
                    $(x).parent().parent().children().children('#tanggal_penerimaan').val(data.penerimaan.tanggal)
                    $(x).parent().parent().children().children().children('#total_penerimaan').val(data.penerimaan.total_harga)
                    $('#discpnm').val(data.penerimaan.diskon_rp)
                    var arr = document.getElementsByName('discpnm[]');
                    var discpnm = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (parseInt(arr[i].value))
                            discpnm += parseInt(arr[i].value);
                    }
                    $('#disk').val(discpnm)
                    $('#diskon').val(0)
                    $('#disko').val(0)
                    $('#diskoo').val(discpnm)
                    $('#diskon').css('display', 'none')
                    if($("#isiformbarang0").children().children('#jumlah_barang').val().length == 0){
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

        diskon = (barang * dis) + discpnm;
        $('#disk').val(diskon)
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