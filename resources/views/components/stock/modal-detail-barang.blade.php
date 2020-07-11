<div class="modal fade" id="modalDetailBarang" tabindex="-1" role="dialog" aria-labelledby="modalDetailBarangLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailBarangLabel">Detail Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row m-2" style="margin-bottom: 2em">
                    <div class="col">
                        <img id="item-image" width="200px" src="#" alt="placeholder image">
                    </div>
                    <div id="namaBarang" class="col">
                        <h3 class="mr-3"></h3>
                        <p>Jumlah Barang di Seluruh Gudang: <span id="jumlahBarang"></span> </p>
                    </div>
                </div>
                <div class="form-group row m-2">

                    <div id="kodeBarang" class="col">
                        <label for="" style="font-weight: bold">Kode Barang</label>
                        <p></p>
                    </div>
                    <div id="kategoriBarang" class="col">
                        <label for="" style="font-weight: bold">Kategori Barang</label>
                        <p></p>
                    </div>
                    <div class="col" id="satuanUnit">
                        <label for="" style="font-weight: bold">Satuan Unit</label>
                        <p></p>
                    </div>
                </div>
                <div class="form-group row m-2">
                    <div class="col" id="hargaGrosir">
                        <label for="" style="font-weight: bold">Harga Grosir</label>
                        <p></p>
                    </div>
                    <div class="col" id="hargaRetail">
                        <label for="" style="font-weight: bold">Harga Retail</label>
                        <p></p>
                    </div>
                    <div class="col" id="hargaJual">
                        <label for="hargaJual" style="font-weight: bold">Harga Jual</label>
                        <p id=""></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>