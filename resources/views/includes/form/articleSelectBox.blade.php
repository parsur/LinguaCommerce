{{-- Article Select Box --}}
<label for="articles">انتخاب مقاله:</label>
<select id="articles" name="articles[]" class="custom-select" multiple="multiple">
  @foreach($articles as $article)
    <option value="{{ $article->id }}" multiple>{{ $article->title }}</option>
  @endforeach
</select>

