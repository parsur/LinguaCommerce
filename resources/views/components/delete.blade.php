
<!-- Delete Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-center">
            <h5>{{ $title }}</h5>
        </div>
        <div class="modal-footer text-center">
            <button type="button" id="deleteSubmission" class="btn btn-success">تایید</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">خروج</button>
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
        </div>
        </div>
    </div>
</div>
