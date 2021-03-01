<div class="row">
    <div class="col-md-6 mb-2">
        {{-- Course Select Box --}}
        <label for="courses">انتخاب دوره:</label>
        <select id="course" name="course" class="custom-select">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>


    {{-- Files --}}
    <div class="col-md-6 mb-4">
        <h6 class="imageLabel">محتوای دوره:</h6>
        <input type="file" name="files[]" multiple/>
    </div>
</div>