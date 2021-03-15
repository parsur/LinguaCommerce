{{-- Course --}}
<label for="course">انتخاب دوره:</label>
<select id="course" name="course" class="custom-select">
    @foreach($courses as $course)
        <option value="{{ $course->id }}">{{ $course->name }}</option>
    @endforeach
</select>