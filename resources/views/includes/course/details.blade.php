{{-- Course detials --}}
@include('includes.courseArticle.details')

{{-- Check if there is any poster --}}
@if(count($table->media))
    {{-- Contents --}}
    <h4 class="mt-1">لینک فایل ها</h4>
    {{-- @forelse($course->files as $key => $content)  --}}
    @forelse($course->files as $file) 
        <a href="{{ $file->url }}">لینک {{ $file->title }}</a> &nbsp;
    @endforeach
@else 
    <hr>
    {{-- It there were not any content --}}
    <x-emptyContent title="محتوایی برای این دوره وجود ندارد" text="افزودن محتوا" route="/courseFile/list" />
@endif
