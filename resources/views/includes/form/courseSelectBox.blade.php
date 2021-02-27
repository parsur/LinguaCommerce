{{-- Course Select Box --}}
<label for="courses">انتخاب دوره:</label>
<select id="courses" name="courses[]" class="custom-select" multiple="multiple">
  @foreach($courses as $course)
    <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
  @endforeach
</select>

