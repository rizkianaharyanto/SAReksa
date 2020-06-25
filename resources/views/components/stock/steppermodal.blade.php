<div>
  <!-- Button trigger modal -->
  {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}
  <link rel="stylesheet" href="{{asset('css/stock/bootstrap.css')}}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="bs-stepper" id="stepper1">
            <div class="bs-stepper-header" role="tablist">
              <!-- your steps here -->
              <div class="step" data-target="#logins-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                  id="logins-part-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Logins</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#information-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                  id="information-part-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Various information</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                <form action="">
                  <label for="kodeKategori">Kode Barang </label>
                  <input class="form-control" type="text" id="kodeKategori" name="kode_kategori">
                  <div class="form-group">
                    <label for="namaKategori">Kategori Barang </label>
                    <select class="form-control" name="kategori_barang" id="namaKategori">
                      @foreach ($kategoriBarang as $itemCat)
                      <option value={{$itemCat->id}}>{{$itemCat->nama_kategori}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jenisBarang">Jenis Barang</label>
                    <input class="form-control" id="jenisBarang" type="text" name="jenis_barang">
                  </div>
                  <div class="form-group">
                    <label for="satuanUnit">Satuan Unit </label>
                    <select class="form-control" name="satuan_unit" id="satuanUnit">
                      @foreach ($satuanUnit as $unit)
                      <option value={{$unit->id}}>{{$unit->nama_satuan}}</option>
                      @endforeach
                    </select>
                  </div>

                </form>
                <button class="btn btn-primary" onclick="next()">Next</button>
              </div>
              <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                <form action="">
                  <label for="">WO2</label>
                  <input type="text">
                </form>
                <button class="btn btn-primary" onclick="previous()">Previous</button>
                <button class="btn btn-primary" onclick="next()">Next</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script>
    $(document).ready(function () {
      var stepper1Node = document.querySelector('#stepper1')
      var stepper1 = new Stepper(document.querySelector('#stepper1'))

      stepper1Node.addEventListener('show.bs-stepper', function (event) {
        console.warn('show.bs-stepper', event)
      })
      stepper1Node.addEventListener('shown.bs-stepper', function (event) {
        console.warn('shown.bs-stepper', event)
      })    
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