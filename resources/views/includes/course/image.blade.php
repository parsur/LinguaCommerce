<div class="row">
    <div class="col-md-6 mb-2">
        {{-- Course Select Box --}}
        <label for="course">انتخاب دوره:</label>
        <select id="course" name="course" class="custom-select">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Image --}}
    @include('includes.courseArticle.image')
</div>