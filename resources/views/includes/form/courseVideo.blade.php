<div class="row">
  {{-- Video --}}
  @include("includes.courseArticle.video")

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