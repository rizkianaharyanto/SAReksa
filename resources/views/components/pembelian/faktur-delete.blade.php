<p>Apakah kamu yakin ingin menghapus Faktur {{ $faktur->kode_faktur }} ?</p>
<div id="footermodal" class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <form method="POST" action="/fakturs/{{$faktur->id}}">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
</div>