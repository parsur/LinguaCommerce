@extends('layouts.admin')
@section('title', 'جزئیات مشاوره')

@section('content')
    <x-page title="جزئیات درخواست مشاوره" description="توضیح و پیام کامل کاربر درباره مشکل">
        <x-slot name="content">
            {{-- details --}}
            <x-textarea key="description" placeholder="توضیحات" value="{!! $consultation->descriptions->description !!}" />
        </x-slot>
    </x-page>
@endsection

@section('scripts')
@parent
    {{-- ckeditor initialization --}}
    <script src="{{ asset('js/ckeditor/ckeditorInitReadOnly.js') }}"></script>
@endsection
