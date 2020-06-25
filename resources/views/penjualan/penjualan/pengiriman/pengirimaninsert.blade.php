@extends('penjualan.template.table', [
    'elementActive' => 'pengiriman'
])
@section('judul', 'Pengiriman')

@section('menu', 'Tambah Pengiriman')

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
                                            <div id="stepper" class="bs-stepper align-self-end" style=" width:80vw; max-height:60vh; color:#212120;">
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
                                                    <form method="POST" action="/penjualan/pengirimans">
                                                        @csrf
                                                        <div id="test-l-1" class="content">
                                                            <input type="hidden" id="status" name="status">
                                                            <input type="hidden" id="akun_barang" name="akun_barang">                                                            <div style="height: 58vh;overflow: auto; color:#212120" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                                                                            <option value="">--- Pilih Pelanggan ---</option>
                                                                            @foreach ($pelanggans as $pelanggan)
                                                                            <option value="{{$pelanggan->id}}">{{ $pelanggan->nama_pelanggan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5" id="pemesanan_form" style="">
                                                                    <label class="col-sm-3 col-form-label" for="pemesanan_id">Pemesanan</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="pemesanan_id" name="pemesanan_id" disabled>
                                                                            <option value="" id="pemesananoption">--- Pilih Pemesanan ---</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="penjual_id">Sales</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="penjual_id" name="penjual_id">
                                                                            <option value="">--- Pilih Sales ---</option>
                                                                            @foreach ($penjuals as $penjual)
                                                                            <option value="{{$penjual->id}}">{{ $penjual->nama_penjual }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="gudang">Gudang</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="gudang" name="gudang">
                                                                            <option value="">--- Pilih Gudang ---</option>
                                                                            @foreach ($gudangs as $gudang)
                                                                            <option value="{{$gudang->id}}">{{ $gudang->kode_gudang }}</option>
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
                                                                        <select class="form-control" id="mata-uang" name="mata_uang">
                                                                            <option value="">--- Pilih Mata Uang ---</option>
                                                                            <option value="">IDR</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/penjualan/pemesanans">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.next()">Selanjutnya</a>
                                                            </div>
                                                        </div>

                                                        <div id="test-l-2" class="content">
                                                            <div style="overflow: auto; height: 52vh;" id="formbarang">
                                                                <div class="form-row mx-5" id="isiformbarang0">
                                                                    <div class="col-md-3">
                                                                        <label for="barang_id" id="lbl">Barang</label>
                                                                        <select class="form-control" onchange="isi(this)" id="barang_id" name="barang_id[]">
                                                                            <option value="">--- Pilih Barang ---</option>
                                                                            @foreach ($barangs as $barang)
                                                                            <option value="{{$barang->id}}">{{ $barang->nama_barang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label for="jumlah_barang">QTY</label>
                                                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onfocus="startCalc(this);" onblur="stopCalc();" placeholder="-">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="satuan_unit">Unit</label>
                                                                        <input type="number" class="form-control" id="uni" disabled>
                                                                        <input type="hidden" id="unit" name="unit_barang[]">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="harga">Harga Satuan</label>
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input type="number" class="form-control" id="harga" name="harga[]" onfocus="startCalc(this);" onblur="stopCalc();" placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="total">Total</label>
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input type="number" class="form-control" id="total" name="total[]" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" id="status_barang" name="status_barang[]" value="belum terkirim">
                                                                    <div class="form-group col-md-1">
                                                                        <p style="color: transparent">#</p>
                                                                        <a onclick="hapus(this)">
                                                                            <i style="color:grey;" class="fas fa-trash"></i>
                                                                        </a>
                                                                    </div>
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
                                                                <a href="/penjualan/pemesanans">
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
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">%</div>
                                                                            </div>
                                                                            <input type="number" class="form-control" id="diskon" onchange="disc();" name="diskon" placeholder="-">
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
                                                                <div class="form-group row m-5 d-flex justify-content-end">
                                                                    <label class="col-sm-3 col-form-label" for="total_harga_keseluruhan">Total</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="width:26vw" type="number" id="total_harga_kes" disabled>
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

    function green(x) {
        x.className = "alert mt-3 alert-light mb-0 p-1";
    }

    function grey(x) {
        x.className = "alert mt-3 mb-0 p-1 alert-primary";
    }

    $('#tambahbarang').click(function() {
        var i = 0;
        $("#formbarang").append($("#isiformbarang" + i).clone().attr('id', 'isiformbarang' + (i + 1)));
        $(document.querySelectorAll("#isiformbarang1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
    });

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
                console.log(data.pemesanans)
                $('#pemesanan_id').removeAttr('disabled')
                for (i = 0; i < 10; i++) {
                    $('#pemesananoption').remove();
                }
                $('#pemesanan_id').append('<option value="" id="pemesananoption">  --- Pilih Pemesanan ---  </option>') 
                for (i = 0; i < data.pemesanans.length; i++) {
                    $('#pemesanan_id').append('<option id="pemesananoption" value="' + data.pemesanans[i].id + '">' + data.pemesanans[i].kode_pemesanan + '</option>')
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
                    console.log(data.pemesanan)
                    console.log(data.barangs)
                    $('#gudang').val(data.pemesanan.gudang)
                    $('#penjual_id').val(data.pemesanan.penjual_id)
                    // $('#tanggal').val(data.pemesanan.tanggal)
                    // $('#mata_uang').val(data.pemesanan.mata_uang)
                    $('#diskon').val(data.pemesanan.diskon)
                    $('#status').val('sudah posting')
                    $('#biaya_lain').val(data.pemesanan.biaya_lain)
                    $('#barang_id').val(data.barangs[0].id)
                    $('#unit').val(data.barangs[0].pivot.unit)
                    $('#uni').attr('placeholder',data.barangs[0].pivot.unit)
                    $('#jumlah_barang').val(data.barangs[0].pivot.barang_belum_diterima)
                    $('#harga').val(data.barangs[0].pivot.harga)
                    // $('#pemesanan_id').val(data.barangs.pemesanan_id)
                    for (var i = 1; i <= data.barangs.length - 1; i++) {
                        $("#formbarang").append($("#isiformbarang0").clone().attr('id', 'isiformbarang' + i));
                        $("#isiformbarang" + i).children().children('select').val(data.barangs[i].id)
                        $("#isiformbarang" + i).children().children('#jumlah_barang').val(data.barangs[i].pivot.barang_belum_diterima)
                        $("#isiformbarang" + i).children().children('#unit').val(data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children('#uni').attr('placeholder', data.barangs[i].pivot.unit)
                        $("#isiformbarang" + i).children().children().children('#harga').val(data.barangs[i].pivot.harga)
                        // $("#isiformbarang" + i).children('#status_barang').val('diterima')
                        // $("#isiformbarang" + i).children().children('input').attr('id', 'total' + i)
                        // $('#total' + i).val(data.barangs[i].pivot.unit)
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
        dis = $('#diskon').val() / 100;
        biy = parseInt($('#biaya_lain').val());
        akhir = parseInt($('#total_harga_barang').val())
        akhir1 = akhir - (akhir * dis)
        akhir2 = akhir1 + biy
        if (akhir2) {
            $('#total_harga_kes').val(akhir2)
            $('#total_harga_keseluruhan').val(akhir2)
        } else {
            $('#total_harga_kes').val(akhir1)
            $('#total_harga_keseluruhan').val(akhir1)
        }
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