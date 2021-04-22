@component('mail::message')
# Introduction

Course files:
@foreach($course->files as $file)
    <a href="{{ $file->url }}">{{ $file->title }}</a>
@endforeach

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
