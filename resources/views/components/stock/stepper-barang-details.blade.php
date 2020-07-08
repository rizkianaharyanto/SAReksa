<div>
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="{{asset('vendor/stock/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('vendor/stock/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/stock/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/stock/fonts/fontawesome/css/fontawesome-all.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/stock/bootstrap-select/css/bootstrap-select.css')}}">

    <!-- Modal -->
    <div class="modal fade" id="barang-details{{$barang->id}}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="bs-stepper" id="stepper1">
                        <div id="stepper1" class="bs-stepper">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#test-l-1">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Data Barang</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#test-l-2">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Harga Barang</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="line"></div>

                                <div class="step" data-target="#test-l-4">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Lainnya</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">

                                <form method="POST" id="formBarang" action="/stok/Management-Data/barang"
                                    enctype="multipart/form-data">
                                    @CSRF
                                    <div id="test-l-1" class="content">
                                        <div class="form-goup">
                                            <label for="kodeKategori">Kode Barang </label>
                                            <p>{{$barang->kode_barang}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="namaKategori">Kategori Barang </label>
                                            <p>{{$barang->kategori_barang}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="namaBarang">Nama Barang </label>
                                            <input class="form-control form-control-lg" value="{{$barang->nama_barang}}"
                                                type="text" id="kodeKategori" name="nama_barang" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="satuanUnit">Satuan Unit </label>
                                            <p>{{$barang->satuan_unit}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="supplier">Supplier</label>
                                            <p>{{$barang->pemasoks}}</p>
                                        </div>

                                        <div class="d-flex justify-content-end">

                                            <button type="button" class="btn btn-primary"
                                                onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-2" class="content">
                                        <div class="form-group">
                                            <label for="hargaRetail">Harga Retail</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <p>{{$barang->harga_retail}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hargaRetail">Harga Grosir</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <p>{{$barang->harga_grosir}}</p>

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="mr-2 btn btn-primary"
                                                onclick="stepper1.previous()">Previous</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="stepper1.next()">Next</button>

                                        </div>
                                    </div>
                                    <div id="test-l-4" class="content">
                                        <div class="form-group">
                                            <label for="">Pajak</label>
                                            <p>{{$barang->pajak_id}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gambar</label>
                                            <img src="{{$barang->item_image}}" alt="">
                                        </div>
                                        <div class="form-group"></div>
                                        <div class="d-flex justify-content-end">

                                            <button type="button" class="mr-2 btn btn-primary"
                                                onclick="stepper1.previous()">Previous</button>

                                            <button type="submit" class="btn btn-dark">Submit</button>
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
    <script src="{{asset('vendor/stock/jquery/jquery-3.3.1.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="{{asset('vendor/stock/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js-->
    <script src="{{asset('vendor/stock/slimscroll/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('vendor/stock/parsley/parsley.js')}}"></script>

    <script src="{{asset('js/stock/main-js.js')}}"></script>

    <script src="{{asset('vendor/stock/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <script>
        $('#formBarang').parsley();
    </script>

    <script>
        var stepper1 = new Stepper(document.querySelector('#stepper1'))
        var stepper1Node = document.querySelector('#stepper1')
  
      
      function next()
      {
        var stepper1 = new Stepper(document.querySelector('#stepper1'))
        stepper1.next();
      }
      function previous()
      {
        var stepper1 = new Stepper(document.querySelector('#stepper1'))
        stepper1.previous();
      }
    </script>
</div>