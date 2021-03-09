@extends('layouts.admin')
@section('جزئیات دوره')

@section('content')
    <x-admin.page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره" formId="">
        <x-slot name="content">
            {{-- course and article details --}}
            @include('includes.course.details' , ['table' => $course])
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
