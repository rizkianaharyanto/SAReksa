<p>Apakah kamu yakin ingin menghapus Pesanan {{ $pemesanan->kode_pemesanan }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form method="POST" action="/pemesanans/{{$pemesanan->id}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>