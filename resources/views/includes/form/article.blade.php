{{-- Article --}}
<label for="article">انتخاب مقاله:</label>
<select id="article" name="article" class="custom-select">
    @foreach($articles as $article)
        <option value="{{ $article->id }}">{{ $article->title }}</option>
    @endforeach
</select>