@extends('layouts.admin')
@section('جزئیات دوره')

@section('content')
    <x-page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره">
        <x-slot name="content">
            {{-- Course detials --}}
            @include('includes.courseArticle.details', ['table' => $course])

            {{-- Check if there is any poster --}}
            @if(count($course->media))
                {{-- Contents --}}
                <h4 class="mt-1">لینک فایل ها</h4>
                {{-- @forelse($course->files as $key => $content)  --}}
                @foreach($course->files as $file) 
                    <a href="{{ $file->url }}">لینک {{ $file->title }}</a> &nbsp;
                @endforeach
            @else 
                <hr>
                {{-- It there were not any content --}}
                <x-empty title="محتوایی برای این دوره وجود ندارد" text="افزودن محتوا" route="/courseFile/list" />
            @endif
        </x-slot>
    </x-page>
@endsection
