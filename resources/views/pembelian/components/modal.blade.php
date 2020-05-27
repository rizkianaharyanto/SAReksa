
<div style="color: black;" class="modal fade"tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" {{$attributes->merge(['id'=>''])}} >
  <div id="lebarmodal" role="document" {{$attributes->merge(['class'=>'modal-dialog modal-dialog-centered'])}}>
    <div class="modal-content">
      <div class="modal-header">
        <div id="judulmodal" class="modal-title d-inline-flex" id="exampleModalLongTitle">
            {{ $title ?? '' }}
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="bodymodal" class="modal-body">
        {{$body ?? ''}}
      </div>
      <!-- <div id="footermodal" class="modal-footer">
        {{$footer ?? ''}}
      </div> -->
    </div>
  </div>
</div>