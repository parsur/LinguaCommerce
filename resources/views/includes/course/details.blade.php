{{-- Course detials --}}
@include('includes.courseArticle.details')

{{-- Check if there is any poster --}}
@if(count($table->media))
    {{-- Contents --}}
    <h4 class="mt-1">لینک فایل ها</h4>
    @forelse($course->files as $key => $content) 
        <a href="{{ $content->url }}">لینک {{ $key + 1 }}</a> &nbsp;
    @endforeach
@else 
    <hr>
    {{-- It there were not content --}}
    <x-emptyContent title="محتوایی برای این دوره وجود ندارد" text="افزودن محتوا" route="/course/fileList" />
@endif
