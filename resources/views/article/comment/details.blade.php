@extends('layouts.admin')
@section('title', 'جزئیات دیدگاه مقاله')

@section('content')
    <x-page title="جزئیات دیدگاه مقاله" description="پیام کامل کاربر درباره دیدگاه مقاله" formId="">
        <x-slot name="content">
            {{-- details --}}
            <x-textarea key="description" name="توضیحات" rows="5" value="{{ $comment->comment }}" />
        </x-slot>
    </x-page>
@endsection
