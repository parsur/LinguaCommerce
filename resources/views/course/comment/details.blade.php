@extends('layouts.admin')
@section('title', 'جزئیات دیدگاه دوره')

@section('content')
    <x-page title="جزئیات دیدگاه دوره" description="پیام کامل کاربر درباره دیدگاه دوره" formId="">
        <x-slot name="content">
            {{-- details --}}
            <x-textarea key="description" name="توضیحات" rows="5" value="{{ $comment->comment }}" />
        </x-slot>
    </x-page>
@endsection
