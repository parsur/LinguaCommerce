@extends('layouts.admin')
@section('title', 'تنظیمات صفحه اصلی')


@section('content')
    <x-page title="تنظیمات صفحه اصلی" description="تنظیمات صفحه خانه" formId="homeSettingForm">
        <x-slot name="content">
            {{-- Home setting form --}}
            @include('includes.form.homeSetting')
        </x-slot>
    </x-page>
@endsection

@section('scripts')
@parent
    <script>
        let action = new requestHandler(null,'#homeSettingForm','homeSetting');
        // Insert
        action.insert();
    </script>
@endsection
