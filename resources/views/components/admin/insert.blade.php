<!-- Modal Creation -->
<div id="formModal" class="modal fade" data-toggle="modal">
    <div class="modal-dialog {{ $size }}">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <div class="modal-body text-right">
          {{-- Form --}}
          <form id="{{ $formId }}" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            <span id="form_output"></span>
  
            @if(isset($content))
              {{ $content }}
            @endif
  
            <br />
            {{-- Buttons --}}
            <div cl ass="form-group" align="center">
              <input type="hidden" name="id" id="id" value="" />
              <input type="hidden" name="button_action" id="button_action" value="insert" />
              <input type="submit" name="submit" id="action" value="تایید" class="btn btn-primary" />
              <button type="button" class="btn btn-danger" data-dismiss="modal">خروج</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
  
  
  