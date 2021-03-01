<div class="row">
    {{-- Video --}}
    <div class="col-md-12 mb-3">
      <label for="aparat_url">لینک ویدئو:</label>
      <textarea rows="3" id="aparat_url" name="aparat_url" type="text" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
    </div>

    <div class="col-md-12 mb-2">
      {{-- Articles --}}
        <label for="articles">انتخاب مقاله:</label>
        <select id="articles" name="articles[]" class="custom-select" multiple="multiple">
            @foreach($articles as $article)
                <option value="{{ $article->id }}" multiple>{{ $article->title }}</option>
            @endforeach
        </select>
    </div>
</div>