<div class="row">
    <div class="col-md-6 mb-2">
        {{-- Articles --}}
        <label for="articles">انتخاب مقاله:</label>
        <select id="articles" name="articles[]" class="custom-select" multiple="multiple">
            @foreach($articles as $article)
                <option value="{{ $article->id }}" multiple>{{ $article->title }}</option>
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