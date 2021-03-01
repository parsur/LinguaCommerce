<div class="row">
    {{-- Video --}}
    <div class="col-md-12 mb-3">
      <label for="aparat_url">لینک ویدئو:</label>
      <textarea rows="3" id="aparat_url" name="aparat_url" type="text" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
    </div>

    <div class="col-md-12 mb-2">
      {{-- Courses --}}
      <label for="courses">انتخاب دوره:</label>
      <select id="courses" name="courses[]" class="custom-select" multiple="multiple">
          @foreach($courses as $course)
            <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
          @endforeach
      </select>
    </div>
</div>