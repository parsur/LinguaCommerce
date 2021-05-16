{{-- Course --}}
<label for="course">انتخاب دوره:</label>
<select id="course" name="{{ $name ?? course }}" class="custom-select" {{ $multiple ?? null }}>
    @foreach($courses as $course)
        <option value="{{ $course->id }}">{{ $course->name }}</option>
    @endforeach
</select>