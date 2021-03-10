<div class="row">
    {{-- Title --}}
    <div class="col-md-12 mb-2">
        <label for="title">عنوان:</label>
        <input type="text" name="title" id="title" placeholder="عنوان" />
    </div>
    {{-- Files --}}
    <div class="col-md-12 mb-2">
        <label for="url">محتوا:</label>
        <textarea name="url" id="url" class="form-control" rows="5" placeholder="لینک محتوا"></textarea>
    </div>
    {{-- Course Select Box --}}
    <div class="col-md-12">
        <label for="courses">انتخاب دوره:</label>
        <select id="course" name="course" class="custom-select">
            @foreach($courses as $course)
                <option value="{{ $course->id }}" multiple>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
</div>