{{-- Form --}}
<div id="submissionModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تایید دیدگاه کاربر</h5>
      </div>
      {{-- Success Message --}}
      <span id="form_output"></span>
      
      <div class="modal-body text-center">
        {{-- Submission --}}
        <button type="button" id="submission" class="btn btn-success">دیدگاه کاربر را تایید میکنم</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">خروج</button>
      </div>
    </div>
  </div>
</div>