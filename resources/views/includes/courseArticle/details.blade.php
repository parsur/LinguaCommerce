<div class="row">
    {{-- Description --}}
    <div class="col-md-12 mb-3">
        <label for="description">توضیحات:</label>
        <textarea id="description" name="description" rows="5" class="form-control">{{ $table->description_type->description }}</textarea>
    </div>
    <hr>
    {{-- Image and Video --}}
    <div class="col-md-4 mb-3">
        @foreach($table->image as $image)
            <img id="imageDetails" src="/images/{{ $image->image_url }}" alt="">
        @endforeach
    </div>

    {{-- Video --}}
    <div class="col-md-12 mb-3">
        <iframe style="margin-bottom: 20px;" src="{{ $table->video->video_url }}" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"  height="400px" width="400px" controls></iframe>
    </div>
</div>

