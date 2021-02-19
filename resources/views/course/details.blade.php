@extends('layouts.admin')
@section('جزئیات دوره')

@section('content')
    <x-admin.page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره" formId="">
        <x-slot name="content">
            @include('includes.courseArticle.details' , ['table' => $course])
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
