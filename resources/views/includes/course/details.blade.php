{{-- Course detials --}}
@include('includes.courseArticle.details')

{{-- Contents --}}
<h4 class="mt-1">لینک فایل ها</h4>
@forelse($course->files as $key => $content) 
    <a href="{{ $content->url }}">لینک {{ $key + 1 }}</a> &nbsp;
@empty
    فایلی برای این دوره وجود ندارد
@endforelse
