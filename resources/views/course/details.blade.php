@extends('layouts.admin')
@section('جزئیات دوره')

@section('content')
    <x-page title="جزئیات دوره" description="جزئیات توضیحات و رسانه دوره" formId="">
        <x-slot name="content">
            {{-- course and article details --}}
            @include('includes.course.details' , ['table' => $course])
        </x-slot>
    </x-page>
@endsection
