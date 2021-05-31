@extends('layouts.admin')
@section('title', 'جزئیات دیدگاه مقاله')

@section('content')
    <x-page title="جزئیات دیدگاه مقاله" description="پیام کامل کاربر درباره دیدگاه مقاله">
        <x-slot name="content">
            {{-- details --}}
            <x-textarea key="description" placeholder="توضیحات" rows="5" value="{{ $comment->comment }}" />
        </x-slot>
    </x-page>
@endsection
