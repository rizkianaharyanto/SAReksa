<div>
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> --}}
    <link rel="stylesheet" href="{{asset('css/stock/bootstrap.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                                <div class="step" data-target="#test-l-3">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Akun</span>
                                    </button>
                                </div>
                                <div class="step" data-target="#test-l-4">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Akun</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form method="POST" action="/stok/Management-Data/barang">
                                    @CSRF
                                    <div id="test-l-1" class="content">
                                        <div class="form-goup">
                                            <label for="kodeKategori">Kode Barang </label>
                                            <input class="form-control" type="text" id="kodeKategori"
                                                name="kode_barang">
                                        </div>
                                        <div class="form-group">
                                            <label for="namaKategori">Kategori Barang </label>
                                            <select class="form-control" name="kategori_barang" id="namaKategori">
                                                @foreach ($kategoriBarang as $itemCat)
                                                <option value={{$itemCat->id}}>{{$itemCat->nama_kategori}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="namaBarang">Nama Barang </label>
                                            <input class="form-control" type="text" id="kodeKategori"
                                                name="nama_barang">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenisBarang">Jenis Barang</label>
                                            <input class="form-control" id="jenisBarang" type="text"
                                                name="jenis_barang">
                                        </div>
                                        <div class="form-group">
                                            <label for="satuanUnit">Satuan Unit </label>
                                            <select class="form-control" name="satuan_unit" id="satuanUnit">
                                                @foreach ($satuanUnit as $unit)
                                                <option value={{$unit->id}}>{{$unit->nama_satuan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="supplier">Supplier</label>
                                            <select class="form-control" name="supplier_id" id="supplier">
                                                @foreach ($gudangs as $gudang)
                                                <option value={{$gudang->id}}>{{$gudang->kode_gudang}}</option>
                                                @endforeach
                                            </select>
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
                                                <input type="number" min="0" class="form-control" id="hargaRetail"
                                                    placeholder="20.000" name="harga_retail">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="hargaRetail">Harga Grosir</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="number" min="0" class="form-control" id="hargaGrosir"
                                                    placeholder="20.000" name="harga_grosir">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="mr-2 btn btn-primary"
                                                onclick="previous()">Previous</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="stepper1.next()">Next</button>

                                        </div>
                                    </div>
                                    <div id="test-l-3" class="content">
                                        <div class="form-group">
                                            <label for="akunHpp">Akun Hpp</label>
                                            <input id="akunHpp" class="form-control" name="akun_hpp" type="text">
                                        </div>
                                        <div class="form-group" for="akunPersediaan">
                                            <label for="akunPersediaan">Akun Persediaan</label>
                                            <input id="akunPersediaan" class="form-control" name="akun_persediaan"
                                                type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="akunPenjualan">Akun Penjualan</label>
                                            <input id="akunPenjualan" class="form-control" name="akun_penjualan"
                                                type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="akunPembelian">Akun Pembelian</label>
                                            <input class="form-control" id="akunPembelian" name="akun_pembelian"
                                                type="text">
                                        </div>
                                        <div class="form-group"></div>
                                        <div class="d-flex justify-content-end">

                                            <button type="button" class="btn btn-primary"
                                                onclick="previous()">Previous</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="stepper1.next()">Next</button>
                                        </div>
                                    </div>
                                    <div id="test-l-4" class="content">
                                        <div class="form-group">
                                            <label for="">Pajak</label>
                                            <input type="text" name="pajak_id" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gambar</label>
                                            <input name="item_image" class="form-control-file" type="file">
                                        </div>
                                        <div class="form-group"></div>
                                        <div class="d-flex justify-content-end">

                                            <button type="button" class="btn btn-primary"
                                                onclick="previous()">Previous</button>

                                            <button type="submit" style="background-color: #0DD3DC; color: white"
                                                class="btn">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        var stepper1 = new Stepper(document.querySelector('#stepper1'))
        var stepper1Node = document.querySelector('#stepper1')
  
        stepper1Node.addEventListener('show.bs-stepper', function (event) {
          console.warn('show.bs-stepper', event)
        })
        stepper1Node.addEventListener('shown.bs-stepper', function (event) {
          console.warn('shown.bs-stepper', event)
        })    
      
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