<p>Apakah kamu yakin ingin menghapus Permintaan {{ $permintaan->kode_permintaan }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form method="POST" action="/permintaans/{{$permintaan->id}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>