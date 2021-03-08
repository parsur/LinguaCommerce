@extends('layouts.admin')
@section('جزئیات دوره')

@section('content')
    <x-admin.page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره" formId="">
        <x-slot name="content">
            {{-- course and article details --}}
            @include('includes.courseArticle.details' , ['table' => $course])
            <h4>لینک فایل ها</h4>

        </x-slot>
    </x-admin.page>
@endsection

@section('scripts')
@parent
    <script>
        tinymce.init({
            selector: 'textarea#description',
            height: 500,
            readonly: 1,
        });
    </script>
@endsection
