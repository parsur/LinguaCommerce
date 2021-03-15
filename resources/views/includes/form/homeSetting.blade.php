<h5>تیتر</h5>
<hr>
<div class="row">
    {{-- Header --}}
    <div class="col-md-6 mb-3">
        <label for="header">سر تیتر</label>
        <input type="text" name="header" value="{{ $setting_header }}" placeholder="سر تیتر">
    </div>
    {{-- Sub header --}}
    <div class="col-md-6 mb-3">
        <label for="sub_header">تیتر</label>
        <input type="text" name="subHeader" value="{{ $setting_subHeader }}" placeholder="تیتر">
    </div>
    {{-- Description --}}
    <div class="col-md-12 mb-3">
        <label for="description">توضیح</label>
        <input type="text" name="description" value="{{ $setting_description }}" placeholder="توضیح">
    </div>
</div>


{{-- News section --}}
<h5>اخبار</h5>
<hr>
<div class="row">
    {{-- First event --}}
    <div class="col-md-6 mb-2">
        <label for="firstEvent">رویداد اول:</label>
        <input rows="5" type="text" name="firstEvent" value="{{ $setting_firstEvent }}" placeholder="رویداد اول">
    </div>
    {{-- First event url --}}
    <div class="col-md-6 mb-3">
        <label for="firstEventUrl">لینک مربوط به رویداد اول:</label>
        <textarea name="firstEventUrl" rows="3" class="form-control"
            placeholder="لینک مربوط به رویداد اول">{{ $setting_firstEventUrl }}</textarea>
    </div>
    {{-- Second event --}}
    <div class="col-md-6 mb-2">
        <label for="secondEvent">رویداد دوم:</label>
        <input type="text" name="secondEvent" value="{{ $setting_secondEvent }}" placeholder="رویداد دوم">
    </div>
    {{-- Second event url --}}
    <div class="col-md-6 mb-3">
        <label for="secondEventUrl">لینک مربوط به رویداد دوم:</label>
        <textarea name="secondEventUrl" rows="3" class="form-control"
            placeholder="لینک مربوط به رویداد دوم">{{ $setting_secondEventUrl }}</textarea>
    </div>
    {{-- Third event --}}
    <div class="col-md-6 mb-2">
        <label for="thirdEvent">رویداد سوم:</label>
        <input type="text" name="thirdEvent" value="{{ $setting_thirdEvent }}" placeholder="رویداد سوم">
    </div>
    {{-- Third event url --}}
    <div class="col-md-6 mb-3">
        <label for="thirdEventUrl">لینک مربوط به رویداد سوم:</label>
        <textarea name="thirdEventUrl" rows="3" class="form-control"
            placeholder="لینک مربوط به رویداد سوم">{{ $setting_thirdEventUrl }}</textarea>
    </div>
    {{-- Fourth event --}}
    <div class="col-md-6 mb-2">
        <label for="fourthEvent">رویداد چهارم:</label>
        <input type="text" name="fourthEvent" value="{{ $setting_fourthEvent }}" placeholder="رویداد چهارم">
    </div>
    {{-- Fourth event url --}}
    <div class="col-md-6 mb-3">
        <label for="fourthEventUrl">لینک مربوط به رویداد چهارم:</label>
        <textarea name="fourthEventUrl" rows="3" class="form-control"
            placeholder="لینک مربوط به رویداد چهارم">{{ $setting_fourthEventUrl }}</textarea>
    </div>
</div>



{{-- Submit button --}}
<div class="col-md-12 text-center">
    <button class="btn btn-primary mb-3 mt-3" type="submit">تاييد</button>
</div>