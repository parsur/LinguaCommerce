<div class="row">
    {{-- Description --}}
    <div class="col-md-12 mb-3">
        <label for="description">توضیحات:</label>
        <textarea id="description" name="description" rows="5" class="form-control">{{ optional($table->description)->description }}</textarea>
    </div>
</div>

<h4 class="mb-3 mt-2">عکس و ویدئو</h4>
<div class="row">
    {{-- Image --}}
    @foreach($table->poster as $image)
        <div class="col-md-3 mb-3">
            <img class="full-media" src="/images/{{ $image->url }}" alt="">
        </div>
    @endforeach

    {{-- Video --}}
    @foreach($table->poster as $video)
        <div class="col-md-6 mb-3">
            <iframe src="{{ $video->url }}" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"  height="250px" width="100%"></iframe>
        </div>
    @endforeach
</div>


