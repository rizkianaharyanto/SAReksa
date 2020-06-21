<p>Apakah kamu yakin ingin menghapus Pembayaran {{ $pembayaran->kode_pembayaran }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form method="POST" action="/penjualan/pembayarans/{{$pembayaran->id}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>