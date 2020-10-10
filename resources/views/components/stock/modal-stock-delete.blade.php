<div>

    <div class="modal fade" id="modalDelete{{$id}}" data-backdrop='static' tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold" id="modalTitle">Anda yakin menghapus {{$header}} ?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Body Here --}}


                    <h2>
                        {{$body ?? ''}}
                    </h2>
                    <form action="{{$deleteAction}}" method="POST">
                        @csrf
                        @method('DELETE')

                    

                </div>
                <div id="modal-footer" class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" style="background-color: #0DD3DC" class="btn btn-primary">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>