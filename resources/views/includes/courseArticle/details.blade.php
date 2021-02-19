<div class="row">
    {{-- Description --}}
    <div class="col-md-12 mb-3">
        <label for="description">توضیحات:</label>
        <textarea id="description" name="description" rows="5" class="form-control">{{ $table->description->description }}</textarea>
    </div>


    {{-- Image and Video --}}
    <h3>عکس ها</h3>
    @foreach($table->image as $image)
        <div class="col-md-3 mb-3">
            <img class="full-media" src="/images/{{ $image->image_url }}" alt="">
        </div>
    @endforeach

    {{-- Video --}}
    <h3>ویدئو ها</h3>
    @foreach($table->video as $video)
        <div class="col-md-6 mb-3">
            <iframe src="{{ $video->video_url }}" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"  height="250px" width="100%"></iframe>
        </div>
    @endforeach
</div>


