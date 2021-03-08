<div class="row">
  {{-- Video --}}
  @include("includes.courseArticle.video")

  <div class="col-md-12 mb-2">
    {{-- Courses --}}
    <label for="courses">انتخاب دوره:</label>
    <select id="course" name="course" class="custom-select">
        @foreach($courses as $course)
          <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>
  </div>
</div>