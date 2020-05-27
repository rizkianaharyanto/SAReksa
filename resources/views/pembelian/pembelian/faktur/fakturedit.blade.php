@extends('template.template')

@section('judul', 'edit')

@section('halaman', 'Edit Faktur')

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
            <div id="test-l-1" class="content">
                <form style="height: 58vh;overflow: auto; color:black" class="mt-2">
                    <div class="form-group row mx-5 mb-5">
                        <label class="col-sm-3 col-form-label" for="nama_supplier">Supplier</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="nama_supplier">
                                @foreach ($suppliers as $supplier)
                                <option>{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mx-5 mb-5">
                        <label class="col-sm-3 col-form-label" for="gudang">Gudang</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="gudang">
                                @foreach ($gudangs as $gudang)
                                <option>{{ $gudang->nama_gudang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mx-5 mb-5">
                        <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tanggal" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row mx-5 mb-5">
                        <label class="col-sm-3 col-form-label" for="mata-uang">Mata Uang</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="mata-uang">
                                <option>IDR</option>
                                <option>$</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <a href="/fakturs">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.next()">Selanjutnya</button>
                </div>
            </div>

            <div id="test-l-2" class="content">
                <div class="d-flex justify-content-center">
                    <p class="mr-5">Buat Faktur berdasarkan : </p>
                    <input class="mx-2" type="radio" name="radio" onclick="checkBarang(this)" />
                    <h5 class="mr-5">Barang</h5>
                    <input class="mx-2" type="radio" name="radio" onclick="checkPenerimaan(this)" />
                    <h5 class="mr-3">Penerimaan</h5>
                </div>
                <hr>
                <div style="display:none" id="checkBarang">
                    <form style="overflow: auto; height: 41vh;" id="formbarang">
                        <div class="form-row mx-5" id="isiformbarang0">
                            <div class="form-group col-md-3">
                                <label for="nama_barang" id="lbl">Barang</label>
                                <select class="form-control" id="nama_barang">
                                    @foreach ($barangs as $barang)
                                    <option>{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="jumlah_barang">QTY</label>
                                <input type="number" class="form-control" id="jumlah_barang" placeholder="-">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="satuan_unit">Unit</label>
                                <input type="number" class="form-control" id="unit" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="harga">Harga Satuan</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" class="form-control" id="harga" placeholder="-">
                                </div>
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
                    </form>
                    <div class="alert alert-primary mt-3 mb-0 p-1" id="tambahbarang" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;">
                        <i class="fas fa-plus d-flex justify-content-center">
                            <span class="mx-2">Tambah Barang</span>
                        </i>
                    </div>
                </div>
                <div style="display:none" id="checkPenerimaan">
                    <form style="overflow: auto; height: 41vh;" id="formpenerimaan">
                        <div class="form-row mx-5" id="isiformpenerimaan0">
                            <div class="form-group col-md-3">
                                <label for="kode_penerimaan">Penerimaan</label>
                                <select class="form-control" id="kode_penerimaan">
                                    @foreach ($penerimaans as $penerimaan)
                                    <option>{{ $penerimaan->kode_penerimaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tanggal_penerimaan">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nama_supplier">Supplier</label>
                                <input type="text" class="form-control" id="nama_supplier" disabled>
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
                    </form>
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
                            <input style="width:26vw" type="number" name="total_harga_penerimaan" id="total_harga_penerimaan" disabled>
                        </div>
                    </div>
                    <a href="/fakturs">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.previous()">Sebelumnya</button>
                    <button class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.next()">Selanjutnya</button>
                </div>
            </div>
            <div id="test-l-3" class="content">
                <form style="height: 58vh;overflow:auto" class="mt-2">
                    <div class="form-group row mx-5 mb-5">
                        <label class="col-sm-3 col-form-label" for="diskon">Diskon</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                                <input type="number" class="form-control" id="diskon" placeholder="-">
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
                                <input type="number" class="form-control" id="biaya_lain" placeholder="-">
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
                                <input type="number" class="form-control" id="uang_muka" placeholder="-">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mx-5 mb-5" id="akun-form" style="display: none">
                        <label class="col-sm-3 col-form-label" for="akun">Akun</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="akun">
                                @foreach ($akuns as $akun)
                                <option>{{ $akun->nama_akun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <div class="d-flex mr-auto">
                        <p class="m-2" id="sisa">Sisa </p>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input style="width:26vw" type="number" name="total_harga_keseluruhan" id="total_harga_keseluruhan" disabled>
                        </div>
                        <input class="ml-4 mt-2" type="checkbox" onclick="checkLunas(this)" />
                        <h5 class="ml-2">Lunas</h5>
                    </div>
                    <a href="/fakturs">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.previous()">Sebelumnya</button>
                    <button type="submit" class="btn" style="background-color:#00BFA6; color:white">Tambah</button>
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
    $('#tambahpenerimaan').click(function() {
        $("#formpenerimaan").append($("#isiformpenerimaan" + i).clone().attr('id', 'isiformpenerimaan' + (i + 1)));
        $(document.querySelectorAll("#isiformpenerimaan1")).children().children().children().css({
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
            $("#akun-form").css('display', 'none')
        } else {
            $(x).attr('value', '1')
            $("#akun-form").removeAttr('style')
            $("#sisa").html('Total')
            $("#uang-muka-form").css('display', 'none')
        }
    }

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformbarang0' || $(x).parent().parent().attr('id') != 'isiformpenerimaan0') {
            $(x).parent().parent().remove();
        }
    }
</script>

@endsection