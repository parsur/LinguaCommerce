@extends('layouts.admin')
@section('title', 'تنظیمات صفحه اصلی')


@section('content')
    <x-admin.page title="تنظیمات صفحه اصلی" description="تنظیمات صفحه خانه" formId="homeSettingForm">
        <x-slot name="content">
            <h5>تیتر</h5>
            <hr>
            <div class="row">
                {{-- Header --}}
                <div class="col-md-6 mb-3">
                    <label for="header">سر تیتر</label>
                    <input value="{{ $setting_header }}" type="text" name="header" placeholder="سر تیتر">
                </div>
                {{-- Sub header --}}
                <div class="col-md-6 mb-3">
                    <label for="sub_header">تیتر</label>
                    <input value="{{ $setting_subHeader }}" type="text" name="subHeader" placeholder="تیتر">
                </div>
            </div>
            {{-- description --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="description">توضیح</label>
                    <input value="{{ $setting_description }}" type="text" name="description" placeholder="توضیح">
                </div>
            </div>
            <!-- Header -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h6 class="imageLabel">تصویر:</h6>
                    <input type="file" name="header"/>
                </div>
                <div class="col-md-12">
                    <img class="image_form mb-3" src="/images/{{ $setting_image }}" />
                </div>
            </div>
            {{-- Submit button --}}
            <div class="col-md-12 text-center">
                <button class="btn btn-primary mb-3 mt-3" type="submit">تاييد</button>
            </div>
        </x-slot>
    </x-admin.page>
@endsection

@section('scripts')
@parent
    <script>
        let action = new requestHandler(null,'#homeSettingForm','homeSetting');
        // Insert
        action.insert();
    </script>
@endsection
