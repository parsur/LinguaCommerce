<div class="row">
  {{-- Video --}}
  @include("includes.courseArticle.video")
  
  <div class="col-md-12 mb-2">
    {{-- Articles --}}
      <label for="articles">انتخاب مقاله:</label>
      <select id="articles" name="article" class="custom-select">
          @foreach($articles as $article)
            <option value="{{ $article->id }}">{{ $article->title }}</option>
          @endforeach
      </select>
  </div>
</div>