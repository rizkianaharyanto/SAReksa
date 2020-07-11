<div>

    <div class="modal fade" id="modalEdit{{$id}}" data-backdrop='static' tabindex="-1" role="dialog"
        aria-labelledby="@yield('modalId')Title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-weight: bold" id="modalTitle">Tambah @yield('title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Body Here --}}
                    <form id="formEdit{{$id}}" action="{{$action}}" method="POST">
                        @csrf
                        {{$content}}

                        <div id="modal-footer" class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submitBtnEdit" style="background-color: #0DD3DC"
                                class="btn btn-primary">Ubah</button>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>