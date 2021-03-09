<div class="row">
    <div class="col-md-12 mb-2">
        {{-- Course Select Box --}}
        <label for="courses">انتخاب دوره:</label>
        <select id="course" name="course" class="custom-select">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>


    {{-- Files --}}
    <div class="col-md-12 mt-3">
        <label for="file">انتخاب دوره:</label>
        <textarea name="url" id="url" class="form-control" rows="5" placeholder="لینک محتوا"></textarea>
    </div>
</div>