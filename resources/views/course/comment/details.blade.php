@extends('layouts.admin')
@section('title', 'جزئیات دیدگاه دوره')

@section('content')
    <x-page title="جزئیات دیدگاه دوره" description="پیام کامل کاربر درباره دیدگاه دوره">
        <x-slot name="content">
            {{-- details --}}
            <x-textarea key="description" placeholder="توضیحات" rows="5" value="{{ $comment->comment }}" />
        </x-slot>
    </x-page>
@endsection
