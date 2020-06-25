<p>Apakah kamu yakin ingin menghapus Penawaran {{ $penawaran->kode_penawaran }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form method="POST" action="/penjualan/penawarans/{{$penawaran->id}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>