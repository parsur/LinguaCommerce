<div class="row">
    <div class="col-md-6 mb-2">
        {{-- Course Select Box --}}
        <label for="courses">انتخاب دوره:</label>
        <select id="courses" name="courses[]" class="custom-select" multiple="multiple">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>


    {{-- Image --}}
    <div class="col-md-6 mb-4">
        <h6 class="imageLabel">تصویر:</h6>
        <input type="file" id="image" name="image" />
        {{-- Hidden Image --}}
        <input type="hidden" id="hidden_image" name="hidden_image"/>
        {{-- Image to be shown --}}
        <img id="picture">
    </div>
</div>