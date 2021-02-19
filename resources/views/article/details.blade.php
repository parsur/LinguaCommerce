@extends('layouts.admin')
@section('جزئیات مقاله')

@section('content')
    <x-admin.page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره" formId="courseForm">
        <x-slot name="content">
            @include('includes.courseArticle.details' , ['table' => $article])
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
