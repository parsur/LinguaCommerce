<h5>تیتر</h5>
<hr>
<div class="row">
    {{-- Header --}}
    <div class="col-md-6 mb-3">
        <x-input key="header" name="سر تیتر" value="{{ $setting_header }}" />
    </div>
    {{-- Sub header --}}
    <div class="col-md-6 mb-3">
        <x-input key="subHeader" name="تیتر" value="{{ $setting_subHeader }}" />
    </div>
    {{-- Description --}}
    <div class="col-md-12 mb-3">
        <x-input key="description" name="توضیحات" value="{{ $setting_description }}" />
    </div>
</div>

{{-- News section --}}
<h5>اخبار</h5>
<hr>
<div class="row">
    {{-- First event --}}
    <div class="col-md-6 mb-2">
        <x-input key="firstEvent" name="رویداد اول" value="{{ $setting_firstEvent }}" />
    </div>
    {{-- First event url --}}
    <div class="col-md-6 mb-3">
        <x-textarea key="firstEventUrl" name="لینک مربوط به رویداد اول" value="{{ $setting_firstEventUrl }}" />
    </div>
    {{-- Second event --}}
    <div class="col-md-6 mb-2">
        <x-input key="secondEvent" name="رویداد دوم" value="{{ $setting_secondEvent }}" />
    </div>
    {{-- Second event url --}}
    <div class="col-md-6 mb-3">
        <x-textarea key="secondEventUrl" name="لینک مربوط به رویداد دوم" value="{{ $setting_secondEventUrl }}" />
    </div>
    {{-- Third event --}}
    <div class="col-md-6 mb-2">
        <x-input key="thirdEvent" name="رویداد سوم" value="{{ $setting_thirdEvent }}" />
    </div>
    {{-- Third event url --}}
    <div class="col-md-6 mb-3">
        <x-textarea key="thirdEventUrl" name="لینک مربوط به رویداد سوم" value="{{ $setting_thirdEventUrl }}" />
    </div>
    {{-- Fourth event --}}
    <div class="col-md-6 mb-2">
        <x-input key="fourthEvent" name="رویداد چهارم" value="{{ $setting_fourthEvent }}" />
    </div>
    {{-- Fourth event url --}}
    <div class="col-md-6 mb-3">
        <x-textarea key="fourthEventUrl" name="لینک مربوط به رویداد چهارم" value="{{ $setting_fourthEventUrl }}" />
    </div>
</div>


{{-- Submit button --}}
<div class="col-md-12 text-center">
    <button class="btn btn-success mb-3 mt-3" type="submit">تاييد</button>
</div>