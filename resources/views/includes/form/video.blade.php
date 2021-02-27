<div class="row">
    {{-- Video --}}
    <div class="col-md-12 mb-3">
      <label for="aparat_url">لینک ویدئو:</label>
      <textarea rows="3" id="aparat_url" name="aparat_url" type="text" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
    </div>

    {{-- Articles --}}
    <div class="col-md-12">
        @include('includes.form.articleSelectBox')
    </div>
</div>