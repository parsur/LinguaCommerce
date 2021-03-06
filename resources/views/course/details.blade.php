@extends('layouts.admin')
@section('جزئیات دوره')

@section('content')
    <x-admin.page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره" formId="">
        <x-slot name="content">
            @include('includes.courseArticle.details' , ['table' => $course])
            <video height='200px' src="{{ asset('storage/courseFiles/CGtoIELTS-video-12.mp4') }}" controls></video>
        </x-slot>
    </x-admin.page>
@endsection

@section('scripts')
@parent
    <script>
        tinymce.init({
            selector: 'textarea#description',
            readonly: 1,
        });
    </script>
@endsection
