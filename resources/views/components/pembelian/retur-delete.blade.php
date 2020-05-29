<p>Apakah kamu yakin ingin menghapus Retur {{ $retur->kode_retur }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form method="POST" action="/returs/{{$retur->id}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>