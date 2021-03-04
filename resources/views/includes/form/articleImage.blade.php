<div class="row">
    <div class="col-md-6 mb-2">
        {{-- Articles --}}
        <label for="articles">انتخاب مقاله:</label>
        <select id="article" name="article" class="custom-select">
            @foreach($articles as $article)
                <option value="{{ $article->id }}" multiple>{{ $article->title }}</option>
            @endforeach
        </select>
    </div>

   {{-- Image --}}
   @include('includes.courseArticle.image')

</div>