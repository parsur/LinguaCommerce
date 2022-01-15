@extends('layouts.admin')
@section('title', 'تنظیمات صفحه اصلی')


@section('content')
    <x-page title="تنظیمات صفحه اصلی" description="تنظیمات صفحه خانه" formId="homeSettingForm">
        <x-slot name="content">
            {{-- Home setting form --}}
            <h5>تیتر</h5>
            <hr>
            <div class="row">
                {{-- Header --}}
                <x-input key="header" name="سر تیتر" 
                            value="{{ $setting_header }}" class="col-md-6 mb-3" />

                {{-- Sub header --}}
                <x-input key="subHeader" name="تیتر"
                            value="{{ $setting_subHeader }}" class="col-md-6 mb-3" />

                {{-- Description --}}
                <x-input key="description" name="توضیحات" 
                            value="{{ $setting_description }}" class="col-md-12 mb-3" />
            </div>
            {{-- News section --}}
            <h5>رویداد</h5>
            <hr>
            <div class="row">
                {{-- First event --}}
                <x-input key="firstEvent" name="رویداد اول" 
                            value="{{ $setting_firstEvent }}" class="col-md-6 mb-2" />

                {{-- First event url --}}
                <x-textarea key="firstEventUrl" placeholder="لینک مربوط به رویداد اول" 
                            value="{{ $setting_firstEventUrl }}" class="col-md-6 mb-3" />

                {{-- Second event --}}
                <x-input key="secondEvent" placeholder="رویداد دوم" 
                            value="{{ $setting_secondEvent }}" class="col-md-6 mb-2" />

                {{-- Second event url --}}
                <x-textarea key="secondEventUrl" placeholder="لینک مربوط به رویداد دوم" 
                            value="{{ $setting_secondEventUrl }}" class="col-md-6 mb-3" />

                {{-- Third event --}}
                <x-input key="thirdEvent" placeholder="رویداد سوم" 
                            value="{{ $setting_thirdEvent }}" class="col-md-6 mb-2" />

                {{-- Third event url --}}
                <x-textarea key="thirdEventUrl" placeholder="لینک مربوط به رویداد سوم" 
                            value="{{ $setting_thirdEventUrl }}" class="col-md-6 mb-3" />

                {{-- Fourth event --}}
                <x-input key="fourthEvent" placeholder="رویداد چهارم" 
                            value="{{ $setting_fourthEvent }}" class="col-md-6 mb-2" />

                {{-- Fourth event url --}}
                <x-textarea key="fourthEventUrl" placeholder="لینک مربوط به رویداد چهارم"
                            value="{{ $setting_fourthEventUrl }}" class="col-md-6 mb-3" />
            </div>
            {{-- Submission --}}
            <div class="col-md-12 text-center mb-3 mt-3">
                <button class="btn btn-success" type="submit">تاييد</button>
            </div>
        </x-slot>
    </x-page>
@endsection

@section('scripts')
@parent
    <script>
        let action = new RequestHandler(null,'#homeSettingForm','homeSetting');
        // Insert
        action.insert();
    </script>
@endsection
