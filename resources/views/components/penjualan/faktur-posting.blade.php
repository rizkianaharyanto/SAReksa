<p>Apakah ingin memposting Faktur {{ $faktur->kode_faktur }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a style="background-color:#212120; color:white" href='/penjualan/fakturs/{{$faktur->id}}/posting' class="btn">Posting</a>
</div>