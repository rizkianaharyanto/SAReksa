@extends('penjualan.template.template', [
    'elementActive' => 'penawaran'
])

@section('judul', 'Edit')

@section('menu', 'Edit Penawaran')

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
                                                    <form method="POST" action="/penjualan/penawarans/{{$penawaran->id}}">
                                                        @method('put')
                                                        @csrf
                                                        <div id="test-l-1" class="content">
                                                        <input type="hidden" id="kode_penawaran" name="kode_penawaran" placeholder="" value="{{$penawaran->kode_penawaran}}">
                                                            <div style="height: 58vh;overflow: auto; color:#212120" class="mt-2">
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="pelanggan_id">Pelanggan</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                                                                            <option value="">--- Pilih Pelanggan ---</option>
                                                                            @foreach ($pelanggans as $pelanggan)
                                                                            <option value="{{$pelanggan->id}}" {{ $pelanggan->id ==  "$penawaran->pelanggan_id" ? "selected" : "" }}>{{ $pelanggan->nama_pelanggan }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="penjual_id">Sales</label>
                                                                    <div class="col-sm-9">
                                                                        <select class="form-control" id="penjual_id" name="penjual_id">
                                                                            <option value="">--- Pilih Sales ---</option>
                                                                            @foreach ($penjuals as $penjual)
                                                                            <option value="{{$penjual->id}}" {{ $penjual->id ==  "$penawaran->penjual_id" ? "selected" : "" }}>{{ $penjual->nama_penjual }} </option>
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
                                                                            <option value="{{$gudang->id}}" {{$gudang->id == "$penawaran->gudang" ? "selected" : "" }}>{{ $gudang->kode_gudang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mx-5 mb-5">
                                                                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$penawaran->tanggal}}">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/penjualan/penawarans">
                                                                    <button type="button" class="btn btn-secondary">Batal</button>
                                                                </a>
                                                                <a class="btn" style="background-color:#212120; color:white" onclick="stepper.next()">Selanjutnya</a>
                                                            </div>
                                                        </div>

                                                        <div id="test-l-2" class="content">
                                                            <div style="overflow: auto; height: 52vh;" id="formbarang">
                                                            @foreach ($penawaran->barangs as $penawaranbarang)
                                                                <div class="form-row mx-5" id="isiformbarang">
                                                                    <div class="col-md-3">
                                                                        <label for="barang_id" id="lbl">Barang</label>
                                                                        <select class="form-control" onchange="isi(this)" id="barang_id" name="barang_id[]">
                                                                            <option value="">--- Pilih Barang ---</option>
                                                                            @foreach ($barangs as $barang)
                                                                            <option value="{{$barang->id}}" {{$barang->id == $penawaranbarang->pivot->barang_id ? "selected" : "" }}>{{ $barang->nama_barang }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label for="jumlah_barang">QTY</label>
                                                                        <input type="number" style="height: 38px" num="0" class="form-control" id="jumlah_barang" name="jumlah_barang[]" onfocus="startCalc(this);" onblur="stopCalc();" value="{{$penawaranbarang->pivot->jumlah_barang}}" placeholder="-">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="satuan_unit">Unit</label>
                                                                        <input type="text"style="height: 38px"  class="form-control" placeholder="{{$penawaranbarang->pivot->unit}}" id="uni" disabled>
                                                                        <input type="hidden" value="{{$penawaranbarang->pivot->unit}}" id="unit" name="unit_barang[]">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label for="harga">Harga Satuan</label>
                                                                        <div class="input-group mb-2">
                                                                            <div style="height: 38px" class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="height: 38px" type="number" num="0" class="form-control" id="harga" name="harga[]" onfocus="startCalc(this);" onblur="stopCalc();" value="{{$penawaranbarang->pivot->harga}}"  placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label for="total">Total</label>
                                                                        <div class="input-group mb-2">
                                                                            <div style="height: 38px" class="input-group-prepend">
                                                                                <div class="input-group-text">Rp</div>
                                                                            </div>
                                                                            <input style="height: 38px" type="number" num="0" class="form-control" id="total" name="total[]" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
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
                                                            <div class="modal-footer">
                                                                <div class="d-flex mr-auto">
                                                                    <p class="m-2">Total </p>
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp</div>
                                                                        </div>
                                                                        <input style="width:26vw" type="number" num="0" name="total_harga_barang" id="total_harga_barang" disabled>
                                                                    </div>
                                                                </div>
                                                                <a href="/penjualan/penawarans">
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
                                                                            <input type="number" num="0" max="100" class="form-control" id="diskon"  name="diskon" value="{{$penawaran->diskon}}" max='100' min='0' onchange="disc();" name="diskon"   placeholder="-">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <div class="input-group-text">Rp</div>
                                                                        </div>
                                                                        <input type="number" num="0" class="form-control" id="disk" onchange="disc();" name="disk" placeholder="-">
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
                                                                            <input type="number" num="0" class="form-control" name="biaya_lain"  id="biaya_lain"  value="{{$penawaran->biaya_lain}}"  placeholder="-">
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
                                                                            <input style="width:26vw" type="number" num="0" id="total_harga_kes" disabled>
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
        // console.log(i)
        $("#formbarang").append($("#isiformbarang").clone().attr('id', 'isiformbarang' + (i + 1)));
        $(document.querySelectorAll("#isiformbarang1")).children().children().children().css({
            'color': 'black',
            'cursor': 'pointer'
        })
        // $("#isiformbarang" + i).attr('id', 'isiformbarang' + (i + 1))
        // $("#delete" + i).attr({
        //     'id': 'delete' + (i + 1),
        //     'value': (i + 1)
        // })
        // console.log(i)
    });

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang') {
            $(x).parent().parent().remove();
        }
    }
    function disc() {
        dis = parseInt($('#diskon').val()) / 100;
        biy = parseInt($('#biaya_lain').val());
        dp = 0
        barang = parseInt($('#total_harga_barang').val())
        $('#akun_barang').val(barang)
        diskon = parseInt(barang * dis)
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