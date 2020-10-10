<p>Apakah ingin memposting Pembayaran {{ $pembayaran->kode_pembayaran }} ?</p>
<div id="footermodal" class="modal-footer">
    <button  type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a style="background-color:#212120; color:white" href='/penjualan/pembayarans/{{$pembayaran->id}}/posting' class="btn">Posting</a>
</div>