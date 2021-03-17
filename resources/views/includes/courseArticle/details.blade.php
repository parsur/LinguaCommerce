<div class="row">
    {{-- Description --}}
    <div class="col-md-12 mb-3">
        <label for="description">توضیحات:</label>
        <textarea id="description" name="description" rows="5"
            class="form-control">{{ optional($table->description)->description }}</textarea>
    </div>
</div>

<hr>

{{-- Check if there is any poster --}}
@if(count($table->media))
    <h4 class="mb-2 mt-2">عکس یا ویدئو</h4>
    <div class="row">
        {{-- Image --}}
        @foreach ($table->media as $image)
            @if ($image->type == 0)
                <div class="col-md-3 mb-3">
                    <img class="full-media" src="/images/{{ $image->url }}" alt="">
                </div>
            @endif
        @endforeach

        {{-- Video --}}
        @foreach ($table->media as $video)
            @if ($video->type == 1)
                <div class="col-md-6 mb-2">
                    <iframe src="{{ $video->url }}" allowFullScreen="true" webkitallowfullscreen="true"
                        mozallowfullscreen="true" height="250px" width="100%"></iframe>
                </div>
            @endif
        @endforeach
    </div>
@else
    {{-- If there were not content --}}
    <x-emptyContent title="رسانه ای برای این مقاله وجود ندارد" text="افزودن رسانه" route="/article/imageList" />
@endif

{{-- Script --}}
@section('scripts')
@parent
    <script>
        // Tinymce implementation
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'autoresize',
            readonly: 1,
            menubar: false,
            toolbar: false
        });
    </script>
@endsection
