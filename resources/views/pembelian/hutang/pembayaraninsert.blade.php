@extends('pembelian.template.template')

@section('judul', 'tambah')

@section('halaman', 'Tambah Pembayaran')

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
                    <span class="bs-stepper-label">hutang</span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <form method="POST" action="/pembelian/pembayarans">
                @csrf
                <div id="test-l-1" class="content">
                    <input type="hidden" id="kode_pembayaran" name="kode_pembayaran" placeholder="" value="BYR{{$no+1}}">
                    <input type="hidden" id="status" name="status">
                    <div style="height: 58vh;overflow: auto; color:black" class="mt-2">
                        <div class="form-group row mx-5 mb-5">
                            <label class="col-sm-3 col-form-label" for="pemasok_id">pemasok</label>
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
                        <a href="/pembelian/pembayarans">
                            <button type="button" class="btn btn-secondary">Batal</button>
                        </a>
                        <a class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.next()">Selanjutnya</a>
                    </div>
                </div>
                <div id="test-l-2" class="content">
                    <div style="overflow: auto; height: 52vh;" id="formhutang">
                        <div class="form-row mx-5" id="isiformhutang0">
                            <div class="form-group col-md-3">
                                <label for="hutang_id" id="lbl">Hutang</label>
                                <select class="form-control" onchange="isi(this)" onclick="hitung()" id="hutang_id" name="hutang_id[]">
                                    <option value="">--- Pilih Hutang ---</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tanggal_hutang">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal_hutang" disabled>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="mata_uang">Mata Uang</label>
                                <input type="number" class="form-control" id="mata_uang" disabled>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="total">Total</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" class="form-control" id="total" name="total[]" disabled>
                                    <input type="hidden" id="total_hutang" name="total_hutang[]">
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
                    <div class="alert alert-primary mt-3 mb-0 p-1" id="tambahhutang" onclick="hitung()" onmouseover="green(this)" onmouseout="grey(this)" style="cursor: pointer; font-size:15px;">
                        <i class="fas fa-plus d-flex justify-content-center">
                            <span class="mx-2">Tambah hutang</span>
                        </i>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex mr-auto">
                            <p class="m-2">Total </p>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input style="width:26vw" type="number" id="total_harga_hutang" disabled>
                                <input type="hidden" name="total_harga" id="total_harga">
                            </div>
                        </div>
                        <a href="/pembelian/hutangs">
                            <button type="button" class="btn btn-secondary">Batal</button>
                        </a>
                        <a class="btn" style="background-color:#00BFA6; color:white" onclick="stepper.previous()">Sebelumnya</a>
                        <button type="submit" class="btn" onclick="hitung()" style="background-color:#00BFA6; color:white">Tambah</button>
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

    function hapus(x) {
        if ($(x).parent().parent().attr('id') != 'isiformhutang0' || $(x).parent().parent().attr('id') != 'isiformhutang0') {
            $(x).parent().parent().remove();
        }
    }

    $('#tambahhutang').click(function() {
        var i = 0;
        $("#formhutang").append($("#isiformhutang0").clone().attr('id', 'isiformhutang' + (i + 1)));
        $(document.querySelectorAll("#isiformhutang1")).children().children().children().css({
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
                for (i = 0; i < data.hutangs.length; i++) {
                    if (data.hutangs[i].faktur_id) {
                        $.ajax({
                            url: '/pembelian/fakturs/' + data.hutangs[i].faktur_id,
                            type: 'get',
                            faktur: {},
                            success: function(faktur) {
                                // console.log(faktur.faktur.hutang_id)
                                $('#hutang_id').append('<option value="' + faktur.faktur.hutang_id + '">' + faktur.faktur.kode_faktur + '</option>')
                            }
                        })
                    } else if (data.hutangs[i].retur_id) {
                        $.ajax({
                            url: '/pembelian/returs/' + data.hutangs[i].retur_id,
                            type: 'get',
                            retur: {},
                            success: function(retur) {
                                // console.log(retur)
                                $('#hutang_id').append('<option value="' + retur.retur.hutang_id + '">' + retur.retur.kode_retur + '</option>')
                            }
                        })
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    });

    function hitung() {
        console.log('hitung')
        var arr = document.getElementsByName('total[]');
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        document.getElementById('total_harga_hutang').value = tot;
        document.getElementById('total_harga').value = tot;
    }


    function isi(x) {
        // console.log(x)
        $.ajax({
            url: '/pembelian/showhutang/' + $(x).val(),
            type: 'get',
            data: {},
            success: function(data) {
                console.log(data)
                // var mata_uang = $(x).parent().parent().children().children('#mata_uang').attr('placeholder', data.mata_uang.nama_satuan)
                $(x).parent().parent().children().children('#mata_uang').val(data.hutang.mata_uang)
                if (data.faktur) {
                    $(x).parent().parent().children().children('#tanggal_hutang').val(data.faktur.tanggal)
                } else if (data.retur) {
                    $(x).parent().parent().children().children('#tanggal_hutang').val(data.retur.tanggal)
                }
                $(x).parent().parent().children().children().children('#total').val(data.hutang.total_hutang)
                $(x).parent().parent().children().children().children('#total_hutang').val(data.hutang.total_hutang)
            }
        })
    }
</script>

@endsection