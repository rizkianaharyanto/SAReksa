@extends('penjualan.template.table', [
    'elementActive' => 'faktur'
])
@section('judul', 'Faktur')

@section('menu', 'Edit Faktur')

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
                                                            <div style="height: 58vh;overflow: auto; color:black" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="pelanggan_id">
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
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="mata-uang">Mata Uang</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="mata-uang">
                                                                            <option>IDR</option>
                                                                        </select>
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
                                                            @if($faktur->pemesanan_id)
                                                            <div style="" id="checkBarang">
                                                                <div style="overflow: auto; height: 41vh;" id="formbarang">
                                                                @foreach ($faktur->barangs as $fakturbarang)
                                                                    <div class="form-row mx-5" id="isiformbarang0">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="nama_barang" id="lbl">Barang</label>
                                                                            <select class="form-control" onchange="isi(this)" id="barang_id" name="barang_id[]">
                                                                                @foreach ($barangs as $barang)
                                                                                <option value="{{$barang->id}}" {{$barang->id == $fakturbarang->pivot->barang_id ? "selected" : "" }}>{{ $barang->nama_barang }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <label for="jumlah_barang">QTY</label>
                                                                            <input type="number" class="form-control"  onfocus="startCalc(this);" onblur="stopCalc();"  id="jumlah_barang" name="jumlah_barang[]" value="{{$fakturbarang->pivot->jumlah_barang}}" placeholder="-">
                                                                        </div>
                                                                        <div class="form-group col-md-1">
                                                                            <label for="satuan_unit">Unit</label>
                                                                            <input type="text" class="form-control" id="uni" value='' placeholder="{{$fakturbarang->pivot->unit}}" disabled>
                                                                            <input type="hidden" value="{{$fakturbarang->pivot->unit}}" id="unit" name="unit_barang[]">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="harga">Harga Satuan</label>
                                                                            <div class="input-group mb-2">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input type="number" class="form-control" onfocus="startCalc(this);" onblur="stopCalc();" id="harga" name="harga[]" value="{{$fakturbarang->pivot->harga}}"  placeholder="-">
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
                                                                    @endforeach
                                                                </div>
                                                                <div class="alert alert-success mt-3 mb-0 p-1" id="tambahbarang" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;color: white;background-color:#212120" role='alert'>
                                                                    <i class="fas fa-plus d-flex justify-content-center">
                                                                        <span class="mx-2">Tambah Barang</span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div style="display:none" id="checkPenerimaan">
                                                                <div style="overflow: auto; height: 41vh;" id="formpengiriman">
                                                                    <div class="form-row mx-5" id="isiformpengiriman0">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="kode_pengiriman">Pengiriman</label>
                                                                            <select class="form-control" id="kode_pengiriman">
                                                                                @foreach ($pengirimans as $pengiriman)
                                                                                <option>{{ $pengiriman->kode_pengiriman }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="tanggal_pengiriman">Tanggal</label>
                                                                            <input type="date" class="form-control" id="tanggal_pengiriman" disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="nama_pelanggan">pelanggan</label>
                                                                            <input type="text" class="form-control" id="nama_pelanggan" disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="total">Total</label>
                                                                            <div class="input-group mb-2">
                                                                                <div class="input-group-prepend">
                                                                                    <div class="input-group-text">Rp</div>
                                                                                </div>
                                                                                <input type="number" class="form-control" id="total" disabled>
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
                                                                        <input style="width:26vw" type="number" name="total_harga_barang" id="total_harga_barang" disabled>
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
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group mb-2">
                                                                            <div class="input-group-prepend">
                                                                                <div class="input-group-text">%</div>
                                                                            </div>
                                                                            <input type="number" class="form-control" id="diskon" onchange="disc();" name="diskon" value="{{$faktur->diskon}}" placeholder="-">
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
                                                                            <input type="number" class="form-control" name="biaya_lain" onchange="disc();" value="{{$faktur->biaya_lain}}" id="biaya_lain" placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="termin_pembayaran">Termin Pembayaran</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="termin_pembayaran">
                                                                            <option>0 % 0 Net 0</option>
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
                                                                            <input type="number" class="form-control" value="{{$faktur->uang_muka}}" id="uang_muka" name="uang_muka" onchange="disc()" placeholder="0">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5" id="akun-form" style="display: none">
                                                                    <label class="col-sm-3 col-form-label" for="akun">Akun</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="akun">
                                                                        
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
        biy = parseInt($('#biaya_lain').val());
        dp = parseInt($('#uang_muka').val());
        barang = parseInt($('#total_harga_barang').val())
        $('#akun_barang').val(barang)
        diskon = (barang * dis)
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